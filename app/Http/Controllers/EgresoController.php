<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Presupuesto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
     * Guardar egreso (varias casillas -> varios movimientos relacionados por presupuesto_id).
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha'           => 'required|date',
            'consecutivo'     => 'nullable|string', // Opcional
            'detalle'         => 'required|string|max:255',
            'concepto'        => 'required|string|max:255',
            'tipo'            => 'required|in:egreso',
            'presupuesto_id'  => 'required|array|min:1',
            'presupuesto_id.*'=> 'required|exists:presupuestos,id',
            'valor'           => 'required|array|min:1',
            'valor.*'         => 'required|numeric|min:0',
        ]);

        // Si el usuario ingresó un consecutivo, verificar que no se repita
        if ($request->filled('consecutivo')) {
            if (Movimiento::where('consecutivo', $request->consecutivo)->exists()) {
                return back()
                    ->withErrors(['consecutivo' => 'El consecutivo ya está en uso.'])
                    ->withInput();
            }
            $consecutivoGrupo = $request->consecutivo;
        } else {
            // Si no envían consecutivo, simplemente lo dejamos NULL
            $consecutivoGrupo = null;
        }

        // Obtener último saldo general
        $ultimoMovimiento = Movimiento::latest('id')->first();
        $saldoActual = $ultimoMovimiento ? ($ultimoMovimiento->saldo ?? 0) : 0;

        // Guardar en transacción para consistencia
        DB::beginTransaction();
        try {
            foreach ($request->presupuesto_id as $index => $idPresupuesto) {
                $presupuesto = Presupuesto::find($idPresupuesto);

                if (!$presupuesto) {
                    throw new \Exception("Presupuesto con id {$idPresupuesto} no existe.");
                }

                $valor = (float) ($request->valor[$index] ?? 0);

                // Restar valor del saldo global
                $saldoActual -= $valor;

                // Crear movimiento
                Movimiento::create([
                    'fecha'          => $request->fecha,
                    'consecutivo'    => $consecutivoGrupo, // Puede ser NULL
                    'detalle'        => $request->detalle,
                    'concepto'       => $request->concepto,
                    'valor'          => $valor,
                    'tipo'           => 'egreso',
                    'saldo'          => $saldoActual,
                    'presupuesto_id' => $idPresupuesto,     // Aquí se relacionan
                    'casilla'        => $presupuesto->nombre_casilla ?? null,
                ]);

                // Actualizar monto del presupuesto si existe esa columna
                if (Schema::hasColumn('presupuestos', 'monto')) {
                    $presupuesto->decrement('monto', $valor);
                } elseif (Schema::hasColumn('presupuestos', 'valor_presupuesto')) {
                    $presupuesto->decrement('valor_presupuesto', $valor);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withErrors(['error' => 'Error guardando egreso: ' . $e->getMessage()])
                ->withInput();
        }

        return redirect()->route('libro.index')
            ->with('success', 'Egreso registrado correctamente.');
    }
}
