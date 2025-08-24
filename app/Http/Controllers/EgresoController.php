<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Presupuesto;
use App\Models\LibroContable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
            'consecutivo'     => 'nullable|string',
            'detalle'         => 'required|string|max:255',
            'concepto'        => 'required|string|max:255',
            'tipo'            => 'required|in:egreso',
            'presupuesto_id'  => 'required|array|min:1',
            'presupuesto_id.*'=> 'required|exists:presupuestos,id',
            'valor'           => 'required|array|min:1',
            'valor.*'         => 'required|numeric|min:0',
        ]);

        // ============================
        // 1) Buscar libro contable abierto
        // ============================
        $libroActual = LibroContable::whereHas('estado', function($q) {
            $q->where('nombre', 'Abierto');
        })->first();

        if (!$libroActual) {
            return back()->withErrors(['error' => 'No hay ningún libro contable abierto.'])->withInput();
        }

        // ============================
        // 2) Validar que la fecha pertenezca al mes y año del libro abierto
        // ============================
        $fechaIngresada = Carbon::parse($request->fecha);

        if ($fechaIngresada->month != $libroActual->mes_libro || $fechaIngresada->year != $libroActual->anio_libro) {
            return back()->withErrors([
                'La fecha debe pertenecer al mes y año del libro contable activo (' . $libroActual->nombre . ').'
            ])->withInput();
        }

        // ============================
        // 3) Validar consecutivo único
        // ============================
        if ($request->filled('consecutivo')) {
            if (Movimiento::where('consecutivo', $request->consecutivo)->exists()) {
                return back()
                    ->withErrors(['consecutivo' => 'El consecutivo ya está en uso.'])
                    ->withInput();
            }
            $consecutivoGrupo = $request->consecutivo;
        } else {
            $consecutivoGrupo = null;
        }

        // ============================
        // 4) Obtener último saldo del libro actual
        // ============================
        $ultimoMovimientoLibro = Movimiento::where('libro_contable_id', $libroActual->id)->latest('id')->first();
        $saldoActual = $ultimoMovimientoLibro ? ($ultimoMovimientoLibro->saldo ?? 0) : 0;

        // ============================
        // 5) Guardar movimientos en transacción
        // ============================
        DB::beginTransaction();
        try {
            foreach ($request->presupuesto_id as $index => $idPresupuesto) {
                $presupuesto = Presupuesto::find($idPresupuesto);
                if (!$presupuesto) {
                    throw new \Exception("Presupuesto con id {$idPresupuesto} no existe.");
                }

                $valor = (float) ($request->valor[$index] ?? 0);

                // Restar valor del saldo del libro actual (egreso disminuye saldo)
                $saldoActual -= $valor;

                Movimiento::create([
                    'fecha'            => $request->fecha,
                    'consecutivo'      => $consecutivoGrupo,
                    'detalle'          => $request->detalle,
                    'concepto'         => $request->concepto,
                    'valor'            => $valor,
                    'tipo'             => 'egreso',
                    'saldo'            => $saldoActual,
                    'presupuesto_id'   => $idPresupuesto,
                    'casilla'          => $presupuesto->nombre_casilla ?? null,
                    'libro_contable_id'=> $libroActual->id, // relación con libro activo
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
