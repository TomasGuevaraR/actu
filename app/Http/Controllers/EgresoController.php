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
        'consecutivo' => 'required|string|unique:movimientos,consecutivo',
        'detalle' => 'required|string',
        'concepto' => 'required|string',
        'valor' => 'required|numeric|min:0',
        'tipo' => 'required|in:egreso',
        'presupuesto_id' => 'required|exists:presupuestos,id', // ← valida la casilla
    ]);

        // Obtener saldo anterior
    $ultimoMovimiento = Movimiento::orderBy('id', 'desc')->first();
    $saldoAnterior = $ultimoMovimiento ? $ultimoMovimiento->saldo : 0;

    // Calcular nuevo saldo
    $nuevoSaldo = $saldoAnterior - $request->valor;

    // Guardar el egreso
    Movimiento::create([
        'fecha' => $request->fecha,
        'consecutivo' => $request->consecutivo,
        'detalle' => $request->detalle,
        'concepto' => $request->concepto,
        'valor' => $request->valor,
        'tipo' => 'egreso',
        'saldo' => $nuevoSaldo,
        'presupuesto_id' => $request->presupuesto_id, // ← importante
        'casilla' => optional(\App\Models\Presupuesto::find($request->presupuesto_id))->nombre_casilla, // opcional
    ]);

    return redirect()->route('libro.index')->with('success', 'Egreso registrado correctamente.');
}
}