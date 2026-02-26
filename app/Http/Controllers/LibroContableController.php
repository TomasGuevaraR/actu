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

        if ($rolUsuario === 'secretario') {
            return view('libro.index', compact('rolUsuario'));
        }

        $libroActual = LibroContable::where('estado', 'activo')
            ->orderBy('anio_libro', 'desc')
            ->orderBy('mes_libro', 'desc')
            ->first();

        if (!$libroActual) {
            $libroActual = LibroContable::orderBy('anio_libro', 'desc')
                ->orderBy('mes_libro', 'desc')
                ->first();
        }

        if (!$libroActual) {
            $libroActual = LibroContable::create([
                'nombre'        => 'Enero ' . date('Y'),
                'mes_libro'     => 1,
                'anio_libro'    => date('Y'),
                'estado'        => 'activo',
                'saldo_inicial' => 0,
            ]);
        }

        $movimientos = $libroActual->movimientos()
            ->orderBy('fecha', 'asc')
            ->orderBy('id', 'asc')
            ->get();

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
            $mov->saldo_actual = $saldoActual;
        }

        return view('libro.index', compact(
            'rolUsuario',
            'libroActual',
            'movimientos',
            'totalEntradas',
            'totalSalidas',
            'saldoActual'
        ));
    }

    public function cerrar($id)
    {
        $libro = LibroContable::findOrFail($id);
        $rolUsuario = Auth::user()->rol;

        // Solo tesorero puede cerrar
        if ($rolUsuario !== 'tesorero') {
            abort(403, 'No tienes permiso para cerrar el libro.');
        }

        // Solo se puede cerrar si está activo
        if ($libro->estado !== 'activo') {
            return redirect()->route('libro.index')
                ->with('error', 'Solo se puede cerrar un libro activo.');
        }

        $libro->estado = 'cerrado';
        $libro->save();

        return redirect()->route('libro.index')
            ->with('success', 'Libro cerrado correctamente.');
    }

    public function aprobar($id)
    {
        $libro = LibroContable::findOrFail($id);
        $rolUsuario = Auth::user()->rol;

        // Solo pastor o fiscal
        if (!in_array($rolUsuario, ['pastor', 'fiscal'])) {
            abort(403, 'No tienes permisos para aprobar.');
        }

        // Solo si está cerrado
        if ($libro->estado !== 'cerrado') {
            return redirect()->route('libro.index')
                ->with('error', 'Solo se puede aprobar un libro cerrado.');
        }

        // Evitar doble aprobación
        if ($rolUsuario === 'pastor' && $libro->aprobado_pastor) {
            return redirect()->route('libro.index');
        }

        if ($rolUsuario === 'fiscal' && $libro->aprobado_fiscal) {
            return redirect()->route('libro.index');
        }

        // Marcar aprobación
        if ($rolUsuario === 'pastor') {
            $libro->aprobado_pastor = true;
        }

        if ($rolUsuario === 'fiscal') {
            $libro->aprobado_fiscal = true;
        }

        // Si ambos aprobaron → proceso final
        if ($libro->aprobado_pastor && $libro->aprobado_fiscal) {

            DB::beginTransaction();

            try {

                $saldoInicial = is_numeric($libro->saldo_inicial)
                    ? (float) $libro->saldo_inicial
                    : 0;

                if (empty($saldoInicial)) {
                    $movSaldo = $libro->movimientos()
                        ->whereRaw("LOWER(detalle) = ?", ['saldo inicial del mes'])
                        ->first();

                    if ($movSaldo && isset($movSaldo->saldo)) {
                        $saldoInicial = (float) $movSaldo->saldo;
                    }
                }

                $totales = $libro->movimientos()
                    ->whereRaw("COALESCE(LOWER(detalle), '') <> ?", ['saldo inicial del mes'])
                    ->selectRaw("
                        SUM(CASE WHEN tipo = 'ingreso' THEN valor ELSE 0 END) as total_ingresos,
                        SUM(CASE WHEN tipo = 'egreso' THEN valor ELSE 0 END) as total_egresos
                    ")
                    ->first();

                $totalIngresos = (float) ($totales->total_ingresos ?? 0);
                $totalEgresos  = (float) ($totales->total_egresos ?? 0);

                $saldoFinal = $saldoInicial + $totalIngresos - $totalEgresos;

                $libro->saldo_final = $saldoFinal;
                $libro->estado = 'aprobado';
                $libro->save();

                // Crear libro siguiente si no existe
                $mesSiguiente  = $libro->mes_libro + 1;
                $anioSiguiente = $libro->anio_libro;

                if ($mesSiguiente > 12) {
                    $mesSiguiente = 1;
                    $anioSiguiente++;
                }

                $existe = LibroContable::where('anio_libro', $anioSiguiente)
                    ->where('mes_libro', $mesSiguiente)
                    ->exists();

                if (!$existe) {

                    $nombreMes = Carbon::createFromDate($anioSiguiente, $mesSiguiente, 1)
                        ->locale('es')
                        ->isoFormat('MMMM');

                    $nuevoLibro = LibroContable::create([
                        'nombre'          => ucfirst($nombreMes) . ' ' . $anioSiguiente,
                        'mes_libro'       => $mesSiguiente,
                        'anio_libro'      => $anioSiguiente,
                        'estado'          => 'activo',
                        'saldo_inicial'   => $saldoFinal,
                        'aprobado_pastor' => false,
                        'aprobado_fiscal' => false,
                    ]);

                    $fechaSaldo = Carbon::createFromDate($anioSiguiente, $mesSiguiente, 1)
                        ->toDateString();

                    $nuevoLibro->movimientos()->create([
                        'fecha'          => $fechaSaldo,
                        'tipo'           => 'saldo_inicial',
                        'valor'          => 0,
                        'saldo'          => $saldoFinal,
                        'detalle'        => 'Saldo inicial del mes',
                        'concepto'       => null,
                        'presupuesto_id' => null,
                    ]);
                }

                DB::commit();

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('libro.index')
                    ->with('error', 'Error al aprobar el libro: ' . $e->getMessage());
            }
        } else {
            $libro->save();
        }

        return redirect()->route('libro.index')
            ->with('success', 'Tu aprobación fue registrada.');
    }

    public function rechazar($id)
    {
        $libro = LibroContable::findOrFail($id);
        $rolUsuario = Auth::user()->rol;

        if (!in_array($rolUsuario, ['pastor', 'fiscal'])) {
            abort(403, 'No tienes permiso para rechazar.');
        }

        if ($libro->estado !== 'cerrado') {
            return redirect()->route('libro.index');
        }

        $libro->estado = 'activo';
        $libro->aprobado_pastor = false;
        $libro->aprobado_fiscal = false;
        $libro->save();

        return redirect()->route('libro.index')
            ->with('success', 'Libro rechazado y reabierto para corrección.');
    }
}