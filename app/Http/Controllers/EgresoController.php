<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Presupuesto;

class EgresoController extends Controller
{
    public function create()
    {
        $casillas = Presupuesto::orderBy('nombre_casilla')->get();
        return view('egresos.create', compact('casillas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'consecutivo' => 'required|string',
            'detalle' => 'required|string',
            'concepto' => 'required|string',
            'tipo' => 'required|in:egreso',
            'presupuesto_id' => 'required|array|min:1',
            'presupuesto_id.*' => 'required|exists:presupuestos,id',
            'valor' => 'required|array|min:1',
            'valor.*' => 'required|numeric|min:0',
        ]);

        // Verificar que el consecutivo no exista en esta transacción
        if (Movimiento::where('consecutivo', $request->consecutivo)->exists()) {
            return back()->withErrors(['consecutivo' => 'El consecutivo ya está en uso.'])->withInput();
        }

        // Obtener saldo inicial del último movimiento
        $ultimoMovimiento = Movimiento::orderBy('id', 'desc')->first();
        $saldoActual = $ultimoMovimiento ? $ultimoMovimiento->saldo : 0;

        // Guardar cada egreso individual
        foreach ($request->presupuesto_id as $index => $idPresupuesto) {
            $presupuesto = Presupuesto::find($idPresupuesto);
            $nombreCasilla = $presupuesto ? $presupuesto->nombre_casilla : '';

            // Descontar del saldo del libro
            $saldoActual -= $request->valor[$index];

            // Crear movimiento
            Movimiento::create([
                'fecha' => $request->fecha,
                'consecutivo' => $request->consecutivo, // mismo para todos
                'detalle' => $request->detalle,
                'concepto' => $request->concepto,
                'valor' => $request->valor[$index],
                'tipo' => 'egreso',
                'saldo' => $saldoActual,
                'presupuesto_id' => $idPresupuesto,
                'casilla' => $nombreCasilla,
            ]);

            // Actualizar presupuesto
            if ($presupuesto) {
                if (isset($presupuesto->monto)) {
                    $presupuesto->monto -= $request->valor[$index];
                    $presupuesto->save();
                }
            }
        }

        return redirect()->route('libro.index')
            ->with('success', 'Egreso registrado correctamente.');
    }
}
