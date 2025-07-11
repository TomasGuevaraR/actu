<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;

class IngresoController extends Controller
{
    /**
     * Mostrar formulario de ingreso.
     */
    public function create()
    {
        return view('ingresos.create');
    }

    /**
     * Guardar el ingreso en la tabla movimientos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'consecutivo' => 'required|string|unique:movimientos,consecutivo',
            'detalle' => 'required|string',
            'concepto' => 'required|string',
            'valor' => 'required|numeric|min:0',
            'tipo' => 'required|in:ingreso',
        ]);

        // Obtener saldo anterior
        $ultimoMovimiento = Movimiento::orderBy('id', 'desc')->first();
        $saldoAnterior = $ultimoMovimiento ? $ultimoMovimiento->saldo : 0;

        // Calcular nuevo saldo
        $nuevoSaldo = $saldoAnterior + $request->valor;

        // Guardar en la base de datos
        Movimiento::create([
            'fecha' => $request->fecha,
            'consecutivo' => $request->consecutivo,
            'detalle' => $request->detalle,
            'concepto' => $request->concepto,
            'valor' => $request->valor,
            'tipo' => 'ingreso',
            'saldo' => $nuevoSaldo,
        ]);

        return redirect()->route('libro.index')->with('success', 'Ingreso registrado correctamente.');
    }
}
