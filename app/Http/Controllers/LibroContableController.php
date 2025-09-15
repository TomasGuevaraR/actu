<?php

namespace App\Http\Controllers;

use App\Models\LibroContable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LibroContableController extends Controller
{
    public function index()
    {
        $rolUsuario = Auth::user()->rol ?? 'sin-rol';

        // Si es secretario, mostrar mensaje de no permisos
        if ($rolUsuario === 'secretario') {
            return view('libro.index', compact('rolUsuario'));
        }

        // Buscar libro con estado 'activo'
        $libroActual = LibroContable::where('estado', 'activo')
            ->orderBy('anio_libro', 'desc')
            ->orderBy('mes_libro', 'desc')
            ->first();

        // Si no hay libro activo, buscar el último libro
        if (!$libroActual) {
            $libroActual = LibroContable::orderBy('anio_libro', 'desc')
                ->orderBy('mes_libro', 'desc')
                ->first();
        }

        // Si no existe ningún libro, crear uno nuevo
        if (!$libroActual) {
            $libroActual = LibroContable::create([
                'nombre'     => 'Enero ' . date('Y'),
                'mes_libro'  => 1,
                'anio_libro' => date('Y'),
                'estado'     => 'activo',
                'monto'      => 0,
                'saldo_inicial' => 0,
            ]);
        }

        // Obtener movimientos del libro actual ordenados por fecha ascendente
        $movimientos = $libroActual->movimientos()
            ->orderBy('fecha', 'asc')  // Primero los más antiguos
            ->orderBy('id', 'asc')     // Segundo criterio: id
            ->get();

        // Calcular saldo acumulado dinámicamente
        $saldoActual = $libroActual->saldo_inicial ?? 0;
        $totalEntradas = 0;
        $totalSalidas = 0;

        foreach ($movimientos as $mov) {
            if ($mov->tipo === 'ingreso') {
                $saldoActual += $mov->valor;
                $totalEntradas += $mov->valor;
            } elseif ($mov->tipo === 'egreso') {
                $saldoActual -= $mov->valor;
                $totalSalidas += $mov->valor;
            }
            $mov->saldo_actual = $saldoActual; // Campo calculado para la vista
        }

        // Enviar a la vista
        return view('libro.index', compact(
            'rolUsuario',
            'libroActual',
            'movimientos',
            'totalEntradas',
            'totalSalidas',
            'saldoActual'  // Saldo final calculado
        ));
    }
    public function cerrar($id)
{
    $libro = LibroContable::findOrFail($id);
    $libro->estado = 'cerrado';
    $libro->save();

    return redirect()->route('libro.index')->with('success', 'Libro cerrado correctamente.');
}

public function aprobar($id)
{
    $libro = LibroContable::findOrFail($id);
    $rolUsuario = Auth::user()->rol;

    // Marcar aprobación según rol
    if ($rolUsuario === 'pastor') {
        $libro->aprobado_pastor = true;
    }
    if ($rolUsuario === 'fiscal') {
        $libro->aprobado_fiscal = true;
    }

    // Solo proceder cuando ambos hayan aprobado y el libro no esté ya aprobado
    if ($libro->aprobado_pastor && $libro->aprobado_fiscal && $libro->estado !== 'aprobado') {
        DB::beginTransaction();
        try {
            // 1) Obtener saldo inicial preferentemente desde la columna del libro
            $saldoInicial = is_numeric($libro->saldo_inicial) ? (float) $libro->saldo_inicial : 0;

            // si no existe en la columna, intentar obtenerlo del movimiento "Saldo inicial del mes"
            if (empty($saldoInicial)) {
                $movSaldo = $libro->movimientos()
                    ->whereRaw("LOWER(detalle) = ?", [trim(strtolower('Saldo inicial del mes'))])
                    ->first();
                if ($movSaldo && isset($movSaldo->saldo)) {
                    $saldoInicial = (float) $movSaldo->saldo;
                }
            }

            // 2) Calcular totales excluyendo el movimiento "Saldo inicial del mes"
            $totales = $libro->movimientos()
                ->whereRaw("COALESCE(LOWER(detalle), '') <> ?", [trim(strtolower('Saldo inicial del mes'))])
                ->selectRaw("
                    SUM(CASE WHEN tipo = 'ingreso' THEN valor ELSE 0 END) as total_ingresos,
                    SUM(CASE WHEN tipo = 'egreso' THEN valor ELSE 0 END) as total_egresos
                ")
                ->first();

            $totalIngresos = (float) ($totales->total_ingresos ?? 0);
            $totalEgresos  = (float) ($totales->total_egresos ?? 0);

            // 3) Calcular saldo final
            $saldoFinal = $saldoInicial + $totalIngresos - $totalEgresos;

            // 4) Actualizar libro (lo marcamos aprobado y guardamos saldo_final)
            $libro->saldo_final = $saldoFinal;
            $libro->estado = 'aprobado';
            $libro->save();

            // 5) Preparar creación del libro siguiente (solo si NO existe ya)
            $mesSiguiente  = $libro->mes_libro + 1;
            $anioSiguiente = $libro->anio_libro;
            if ($mesSiguiente > 12) {
                $mesSiguiente = 1;
                $anioSiguiente++;
            }

            $existe = LibroContable::where('anio_libro', $anioSiguiente)
                        ->where('mes_libro', $mesSiguiente)
                        ->exists();

            if (! $existe) {
                // Nombre bonito del mes en español
                $nombreMes = Carbon::createFromDate($anioSiguiente, $mesSiguiente, 1)
                                    ->locale('es')
                                    ->isoFormat('MMMM'); // p.ej. "febrero"
                $nombreCompleto = ucfirst($nombreMes) . ' ' . $anioSiguiente;

                $nuevoLibro = LibroContable::create([
                    'nombre'          => $nombreCompleto,
                    'mes_libro'       => $mesSiguiente,
                    'anio_libro'      => $anioSiguiente,
                    'estado'          => 'activo',
                    'saldo_inicial'   => $saldoFinal,
                    'aprobado_pastor' => false,
                    'aprobado_fiscal' => false,
                ]);

                // 6) Insertar movimiento de "saldo inicial" en el libro nuevo
                // fecha = primer día del mes nuevo
                $fechaSaldo = Carbon::createFromDate($anioSiguiente, $mesSiguiente, 1)->toDateString();

                // IMPORTANTE: si tu columna `tipo` es un ENUM('ingreso','egreso'), agrega 'saldo_inicial' al ENUM
                // Si no quieres tocar el ENUM, pon 'tipo' => null en el insert (si la columna admite null).
                $tipoSaldo = 'saldo_inicial';

                // Usamos Eloquent si la relación movimientos está definida
                $nuevoLibro->movimientos()->create([
                    'fecha'             => $fechaSaldo,
                    'consecutivo'       => null,
                    'tipo'              => $tipoSaldo,    // o null si tu esquema no acepta 'saldo_inicial'
                    'valor'             => 0,
                    'saldo'             => $saldoFinal,
                    'detalle'           => 'Saldo inicial del mes',
                    'concepto'          => null,
                    'presupuesto_id'    => null,
                    // 'libro_contable_id' se rellena automáticamente por la relación
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('libro.index')
                ->with('error', 'Error al aprobar el libro: ' . $e->getMessage());
        }
    } else {
        // si aún no está la otra aprobación, solo guardamos los flags (no cerramos ni creamos)
        $libro->save();
    }

    return redirect()->route('libro.index')->with('success', 'Tu aprobación fue registrada.');
}

public function rechazar($id)
{
    $libro = LibroContable::findOrFail($id);
    $libro->estado = 'activo';
    $libro->aprobado_pastor = false;
    $libro->aprobado_fiscal = false;
    $libro->save();

    return redirect()->route('libro.index')->with('success', 'Libro rechazado y reabierto para corrección.');
}

}