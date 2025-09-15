<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Presupuesto;
use App\Models\LibroContable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Egreso;


class EgresoController extends Controller
{
    /**
     * Mostrar formulario para crear egreso.
     */
    public function create()
    {
        $casillas = Presupuesto::orderBy('nombre_casilla')->get();
        return view('egresos.create', compact('casillas'));
    }

    /**
     * Guardar egreso (varias casillas -> varios movimientos relacionados por grupo_id).
     */
    public function store(Request $request)
    {
        // 1) Buscar libro contable activo
        $libro = LibroContable::where('estado', 'activo')->first();
        if (!$libro) {
            return back()->withErrors(['error' => 'No hay un libro contable activo.'])->withInput();
        }

        // 2) Calcular rango de fechas permitido
        $fechaInicio = Carbon::createFromDate($libro->anio_libro, $libro->mes_libro, 1)->startOfMonth();
        $fechaFin    = Carbon::createFromDate($libro->anio_libro, $libro->mes_libro, 1)->endOfMonth();

        // 3) Validar datos de entrada
        $request->validate([
            'fecha'           => ['required', 'date', 'after_or_equal:' . $fechaInicio->format('Y-m-d'), 'before_or_equal:' . $fechaFin->format('Y-m-d')],
            'consecutivo'     => 'nullable|string',
            'detalle'         => 'required|string|max:255',
            'concepto'        => 'required|string|max:255',
            'tipo'            => 'required|in:egreso',
            'presupuesto_id'  => 'required|array|min:1',
            'presupuesto_id.*'=> 'required|exists:presupuestos,id',
            'valor'           => 'required|array|min:1',
            'valor.*'         => 'required|numeric|min:0',
        ]);

        // 4) Validar consecutivo único (opcional)
        $consecutivoGrupo = $request->filled('consecutivo') ? $request->consecutivo : null;
        if ($consecutivoGrupo && Movimiento::where('consecutivo', $consecutivoGrupo)->exists()) {
            return back()->withErrors(['consecutivo' => 'El consecutivo ya está en uso.'])->withInput();
        }

        // 5) Obtener último saldo del libro actual
        $ultimoMovimientoLibro = Movimiento::where('libro_contable_id', $libro->id)->latest('id')->first();
        $saldoActual = $ultimoMovimientoLibro ? ($ultimoMovimientoLibro->saldo ?? 0) : 0;

        // 6) Generar grupo_id único
        $grupoId = Str::uuid()->toString();

        DB::beginTransaction();
        try {
            $totalEgreso = 0;
            $casillasList = [];

            // 7) Calcular total y lista de casillas
            foreach ($request->presupuesto_id as $index => $idPresupuesto) {
                $presupuesto = Presupuesto::find($idPresupuesto);
                $valor = (float) ($request->valor[$index] ?? 0);
                $totalEgreso += $valor;
                $casillasList[] = $presupuesto->nombre_casilla ?? 'Desconocida';
            }

            // 8) Guardar movimiento resumen
            $movimiento = Movimiento::create([
                'fecha'             => $request->fecha,
                'consecutivo'       => $consecutivoGrupo,
                'detalle'           => $request->detalle,
                'concepto'          => $request->concepto,
                'valor'             => $totalEgreso,
                'tipo'              => 'egreso',
                'saldo'             => $saldoActual - $totalEgreso,
                'presupuesto_id'    => null,
                'casilla'           => implode(', ', $casillasList),
                'libro_contable_id' => $libro->id,
                'grupo_id'          => $grupoId,
            ]);

            // 9) Guardar egresos individuales vinculados al movimiento
            foreach ($request->presupuesto_id as $index => $idPresupuesto) {
                $presupuesto = Presupuesto::find($idPresupuesto);
                $valor = (float) ($request->valor[$index] ?? 0);

                DB::table('egresos')->insert([
                    'fecha' => $request->fecha,
                    'valor' => $valor,
                    'detalle' => $request->detalle,
                    'concepto' => $request->concepto,
                    'presupuesto_id' => $idPresupuesto,
                    'movimiento_id' => $movimiento->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 10) Actualizar monto del presupuesto
                if (Schema::hasColumn('presupuestos', 'monto')) {
                    $presupuesto->decrement('monto', $valor);
                } elseif (Schema::hasColumn('presupuestos', 'valor_presupuesto')) {
                    $presupuesto->decrement('valor_presupuesto', $valor);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error guardando egreso: ' . $e->getMessage()])->withInput();
        }

        return redirect()->route('libro.index')->with('success', 'Egreso registrado correctamente.');
    }

    /**
 * Mostrar formulario para editar un egreso.
 */
public function edit($id)
{
    $egreso = Egreso::findOrFail($id);

    // Movimiento resumen
    $movimiento = Movimiento::findOrFail($egreso->movimiento_id);

    // Todos los egresos del grupo
    $egresos = Egreso::where('movimiento_id', $movimiento->id)->get();

    $casillas = Presupuesto::orderBy('nombre_casilla')->get();

    return view('egresos.edit', compact('movimiento', 'egresos', 'casillas'));
}


/**
 * Actualizar egreso.
 */
public function update(Request $request, $id)
{
    $movimientoResumen = Movimiento::findOrFail($id);

    $request->validate([
        'fecha'            => 'required|date',
        'consecutivo'      => 'nullable|string|unique:movimientos,consecutivo,'.$movimientoResumen->id,
        'detalle'          => 'required|string|max:255',
        'concepto'         => 'required|string|max:255',
        'egreso_id'        => 'required|array',
        'egreso_id.*'      => 'required|integer|exists:egresos,id',
        'presupuesto_id'   => 'required|array',
        'presupuesto_id.*' => 'required|exists:presupuestos,id',
        'valor'            => 'required|array',
        'valor.*'          => 'required|numeric|min:0',
    ]);

    DB::beginTransaction();
    try {
        $totalEgreso = 0;
        $casillasList = [];

        foreach ($request->egreso_id as $index => $egresoId) {
            $egreso = Egreso::findOrFail($egresoId);
            $valor = (float) $request->valor[$index];
            $idPresupuesto = $request->presupuesto_id[$index];

            $presupuesto = Presupuesto::findOrFail($idPresupuesto);

            // Actualizar egreso
            $egreso->update([
                'fecha'          => $request->fecha,
                'detalle'        => $request->detalle,
                'concepto'       => $request->concepto,
                'valor'          => $valor,
                'presupuesto_id' => $idPresupuesto,
            ]);

            $totalEgreso += $valor;
            $casillasList[] = $presupuesto->nombre_casilla;
        }

        // Actualizar movimiento resumen
        $movimientoResumen->update([
            'fecha'       => $request->fecha,
            'consecutivo' => $request->consecutivo,
            'detalle'     => $request->detalle,
            'concepto'    => $request->concepto,
            'valor'       => $totalEgreso,
            'casilla'     => implode(', ', $casillasList),
        ]);

        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Error actualizando egreso: ' . $e->getMessage()])->withInput();
    }

    return redirect()->route('libro.index')->with('success', 'Egreso actualizado correctamente.');
}

}
