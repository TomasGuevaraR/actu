<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Presupuesto;
use App\Models\Diezmo;
use Illuminate\Support\Facades\DB;

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
            ->whenEmpty(fn () => collect([$movimiento]));

        $casillas = Presupuesto::orderBy('nombre_casilla')->get();

        return view('movimientos.edit', compact('movimiento', 'movimientos', 'casillas'));
    }

    /**
     * Actualizar movimiento
     */
    public function update(Request $request, $id)
    {
        $movimiento = Movimiento::findOrFail($id);

        if ($movimiento->tipo === 'ingreso') {
            // 🔹 Normalizar valor con función auxiliar
            $valorNormalizado = $this->normalizarNumero($request->input('valor'));

            $request->merge([
                'valor' => $valorNormalizado
            ]);

            $request->validate([
                'fecha'       => 'required|date',
                'consecutivo' => 'nullable|string|max:50',
                'detalle'     => 'required|string|max:255',
                'concepto'    => 'required|string|max:255',
                'valor'       => 'required|numeric|min:0',
            ]);

            // 🔹 Asignar libro contable si no lo tiene
            if (!$movimiento->libro_contable_id) {
                $estadoAbiertoId = \App\Models\LibroContableEstado::where('nombre', 'Abierto')->value('id');
                $libroActual = \App\Models\LibroContable::where('estado_id', $estadoAbiertoId)->first();
                if ($libroActual) {
                    $movimiento->libro_contable_id = $libroActual->id;
                }
            }

            // ✅ Actualizar ingreso
            $movimiento->update([
                'fecha'       => $request->fecha,
                'consecutivo' => $request->consecutivo ?? $movimiento->consecutivo,
                'detalle'     => $request->detalle,
                'concepto'    => $request->concepto,
                'valor'       => $request->valor,
                'libro_contable_id' => $movimiento->libro_contable_id,
            ]);
        } else {
            // 🔹 Normalizar array de valores (quita separadores de miles y transforma)
            $valoresNormalizados = collect($request->input('valor', []))
                ->map(fn($v) => $this->normalizarNumero($v))
                ->toArray();

            $request->merge([
                'valor' => $valoresNormalizados
            ]);

            $request->validate([
                'fecha'           => 'required|date',
                'consecutivo'     => 'nullable|string|max:50',
                'detalle'         => 'required|string|max:255',
                'concepto'        => 'required|string|max:255',
                'movimiento_id'   => 'required|array',
                'movimiento_id.*' => 'exists:movimientos,id',
                'presupuesto_id'  => 'required|array',
                'presupuesto_id.*'=> 'nullable|exists:presupuestos,id',
                'valor'           => 'required|array',
                'valor.*'         => 'numeric|min:0',
            ]);

            $submitted_ids = $request->input('movimiento_id', []);
            $presupuestos  = $request->input('presupuesto_id', []);
            $valores       = $request->input('valor', []);

            DB::transaction(function () use ($submitted_ids, $presupuestos, $valores, $request, $movimiento) {
                foreach ($submitted_ids as $index => $mov_id) {
                    $data = [
                        'fecha'         => $request->fecha,
                        'consecutivo'   => $request->consecutivo ?? $movimiento->consecutivo,
                        'detalle'       => $request->detalle,
                        'concepto'      => $request->concepto,
                        'presupuesto_id'=> $presupuestos[$index] ?? null,
                        'valor'         => $valores[$index] ?? 0,
                    ];

                    // 🔹 Asignar libro contable si no lo tiene
                    if (!$movimiento->libro_contable_id) {
                        $estadoAbiertoId = \App\Models\LibroContableEstado::where('nombre', 'Abierto')->value('id');
                        $libroActual = \App\Models\LibroContable::where('estado_id', $estadoAbiertoId)->first();
                        if ($libroActual) {
                            $data['libro_contable_id'] = $libroActual->id;
                        }
                    }

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
        }

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
            ->where('tipo', $movimiento->tipo)
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

    /**
     * 🔹 Función auxiliar para normalizar valores numéricos
     */
    private function normalizarNumero($valor)
    {
        if ($valor === null || $valor === '') {
            return 0;
        }

        // 1) Quitar separadores de miles (puntos)
        $valor = str_replace('.', '', $valor);

        // 2) Reemplazar coma decimal por punto
        $valor = str_replace(',', '.', $valor);

        return floatval($valor);
    }
}
