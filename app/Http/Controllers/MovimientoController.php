<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Presupuesto;
use App\Models\Diezmo; // 👈 para ingresos
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MovimientoController extends Controller
{
    /**
     * Editar movimiento
     */
    public function edit($id)
{
    $movimiento = Movimiento::findOrFail($id);

    // ✅ Caso 1: Ingreso → solo cargamos este movimiento
    if ($movimiento->tipo === 'ingreso') {
        return view('ingresos.edit', [
            'movimiento'  => $movimiento,
            'movimientos' => collect([$movimiento]),
        ]);
    }

    // ✅ Caso 2: Egreso → buscamos movimientos relacionados
    $movimientos = Movimiento::with('presupuesto:id,nombre_casilla')
        ->where('consecutivo', $movimiento->consecutivo)
        ->where('concepto', $movimiento->concepto)
        ->where('tipo', 'egreso')
        ->orderBy('id')
        ->get()
        ->whenEmpty(fn () => collect([$movimiento])); // si no encuentra nada, usa el movimiento actual

    // ✅ Casillas solo se cargan cuando son necesarias
    $casillas = Presupuesto::orderBy('nombre_casilla')->get();

    return view('movimientos.edit', compact('movimiento', 'movimientos', 'casillas'));
}


    /**
     * Actualizar movimiento
     */
    public function update(Request $request, $id)
    {
        $movimiento = Movimiento::findOrFail($id);

        $request->validate([
            'fecha' => 'required|date',
            'consecutivo' => 'nullable|string|max:50',
            'detalle' => 'required|string|max:255',
            'concepto' => 'required|string|max:255',

            // Reglas para egresos (líneas con casillas)
            'movimiento_id' => 'required|array',
            'movimiento_id.*' => 'exists:movimientos,id',
            'presupuesto_id' => 'required|array',
            'presupuesto_id.*' => 'nullable|exists:presupuestos,id',
            'valor' => 'required|array',
            'valor.*' => 'numeric|min:0',
        ]);

        $submitted_ids = $request->input('movimiento_id', []);
        $presupuestos = $request->input('presupuesto_id', []);
        $valores = $request->input('valor', []);

        DB::transaction(function () use ($submitted_ids, $presupuestos, $valores, $request, $movimiento) {
            foreach ($submitted_ids as $index => $mov_id) {
                $data = [
                    'fecha' => $request->fecha,
                    'consecutivo' => $request->consecutivo ?? $movimiento->consecutivo,
                    'detalle' => $request->detalle,
                    'concepto' => $request->concepto,
                    'presupuesto_id' => $presupuestos[$index] ?? null,
                    'valor' => $valores[$index] ?? 0,
                ];

                $target = Movimiento::where('id', $mov_id)
                    ->where('consecutivo', $movimiento->consecutivo)
                    ->first();

                if ($target) {
                    $target->update($data);
                } else {
                    Movimiento::create($data);
                }
            }
        });

        return redirect()->route('libro.index')
            ->with('success', 'Registro actualizado correctamente ✅');
    }

    /**
     * Eliminar movimiento
     */
    public function destroy($id)
    {
        $movimiento = Movimiento::findOrFail($id);

        Movimiento::where('consecutivo', $movimiento->consecutivo)
            ->where('concepto', $movimiento->concepto)
            ->where('tipo', $movimiento->tipo) // 👈 importante para no mezclar ingresos con egresos
            ->delete();

        return redirect()->route('libro.index')
            ->with('success', 'Movimiento eliminado correctamente 🗑️');
    }

    /**
     * Retornar detalles para el modal dinámico (Ingreso o Egreso)
     */
    public function detalles($id)
    {
        $movimiento = Movimiento::findOrFail($id);

        if ($movimiento->tipo === 'ingreso') {
            $diezmos = Diezmo::where('movimiento_id', $movimiento->id)->get();

            $detalles = $diezmos->map(function ($d) {
                return [
                    'nombre' => $d->nombre ?? '(sin nombre)',
                    'valor'  => (float) $d->valor,
                    'fecha'  => $d->fecha
                        ? (is_a($d->fecha, \Carbon\Carbon::class) ? $d->fecha->format('Y-m-d') : (string) $d->fecha)
                        : null,
                ];
            });

            return response()->json([
                'tipo' => 'ingreso',
                'detalles' => $detalles,
                'movimiento' => $movimiento
            ]);
        } else {
            $movimientos = Movimiento::with('presupuesto:id,nombre_casilla')
                ->where('consecutivo', $movimiento->consecutivo)
                ->where('concepto', $movimiento->concepto)
                ->where('tipo', 'egreso')
                ->orderBy('id')
                ->get();

            $detalles = $movimientos->map(function ($m) {
                return [
                    'casilla' => optional($m->presupuesto)->nombre_casilla ?? '(sin casilla)',
                    'valor'   => (float) $m->valor,
                ];
            });

            return response()->json([
                'tipo' => 'egreso',
                'detalles' => $detalles,
                'movimiento' => $movimiento
            ]);
        }
    }
}
