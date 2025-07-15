<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diezmo;
use App\Models\Movimiento;
use App\Models\Estado;
use Carbon\Carbon;

class DiezmoController extends Controller
{
    public function index()
    {
        return view('diezmo.index');
    }

    public function create()
    {
        return view('diezmo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha'     => 'required|date',
            'detalle'   => 'required|string',
            'concepto'  => 'required|string',
            'nombres'   => 'required|array',
            'nombres.*' => 'required|string',
            'valores'   => 'required|array',
            'valores.*' => 'required|numeric|min:0',
            'ofrenda'   => 'nullable|numeric|min:0',
        ]);

        $fecha = $request->fecha;
        $ofrenda = $request->ofrenda ?? 0;
        $totalDiezmos = 0;

        // 1. Guardar diezmos individuales
        foreach ($request->nombres as $i => $nombre) {
            $valor = $request->valores[$i];

            Diezmo::create([
                'fecha'  => $fecha,
                'nombre' => $nombre,
                'valor'  => $valor,
            ]);

            $totalDiezmos += $valor;
        }

        // 2. Calcular total general
        $totalGeneral = $totalDiezmos + $ofrenda;

        // 3. Obtener el último saldo para calcular el nuevo
        $ultimoMovimiento = Movimiento::orderBy('id', 'desc')->first();
        $saldoAnterior = $ultimoMovimiento ? $ultimoMovimiento->saldo : 0;
        $nuevoSaldo = $saldoAnterior + $totalGeneral;

        // 4. Guardar movimiento contable general
        Movimiento::create([
            'fecha'     => $fecha,
            'detalle'   => $request->detalle,
            'concepto'  => $request->concepto,
            'valor'     => $totalGeneral,
            'tipo'      => 'ingreso',
            'saldo'     => $nuevoSaldo,
        ]);

        return redirect()->route('libro.index')->with('success', 'Diezmos y ofrenda registrados correctamente.');
    }
}
