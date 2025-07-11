<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Presupuesto; 

class EgresoController extends Controller
{
    public function create()
    {
        $casillas = Presupuesto::all();

        return view('egresos.create', compact('casillas')); // ← Aquí las pasas a la vista
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'consecutivo' => 'required|string|unique:movimientos,detalle',
            'detalle' => 'required|string',
            'concepto' => 'required|string',
            'valor' => 'required|numeric|min:0',
            'origen' => 'required|string',
            'tipo' => 'required|in:egreso',
        ]);

        $ultimoMovimiento = Movimiento::orderBy('id', 'desc')->first();
        $saldoAnterior = $ultimoMovimiento ? $ultimoMovimiento->saldo : 0;

        $nuevoSaldo = $saldoAnterior - $request->valor;

        Movimiento::create([
    'fecha' => $request->fecha,
    'consecutivo' => $request->consecutivo,
    'detalle' => $request->detalle,
    'concepto' => $request->concepto,
    'casilla' => $request->origen, 
    'valor' => $request->valor,
    'tipo' => 'egreso',
    'saldo' => $nuevoSaldo,
]);


        return redirect()->route('libro.index')->with('success', 'Egreso registrado correctamente.');
    }
}

