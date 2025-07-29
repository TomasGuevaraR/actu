<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diezmo;
use App\Models\Movimiento;
use App\Models\Miembro;
use Carbon\Carbon;

class DiezmoController extends Controller
{
    public function index()
    {
        // Este método carga la vista con la lista de miembros para poder mostrarlos en el formulario
        $miembros = Miembro::selectRaw("CONCAT(nombres, ' ', apellidos) as nombre_completo")->pluck('nombre_completo');
        return view('diezmo.index', compact('miembros'));
    }

    public function create()
    {
        // Puedes usar este método si planeas mostrar un formulario separado para crear
        $miembros = Miembro::all();
        return view('diezmo.index', compact('miembros'));
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
        $detalle = $request->detalle;
        $concepto = $request->concepto;
        $ofrenda = $request->ofrenda ?? 0;
        $totalDiezmos = array_sum($request->valores);
        $totalGeneral = $totalDiezmos + $ofrenda;

        // Obtener saldo anterior
        $ultimoMovimiento = Movimiento::latest('id')->first();
        $saldoAnterior = $ultimoMovimiento ? $ultimoMovimiento->saldo : 0;
        $nuevoSaldo = $saldoAnterior + $totalGeneral;

        // Crear movimiento general
        $movimiento = Movimiento::create([
            'fecha'    => $fecha,
            'detalle'  => $detalle,
            'concepto' => $concepto,
            'valor'    => $totalGeneral,
            'tipo'     => 'ingreso',
            'saldo'    => $nuevoSaldo,
        ]);

        // Registrar los diezmos individuales
        foreach ($request->nombres as $i => $nombre) {
            Diezmo::create([
                'fecha'         => $fecha,
                'nombre'        => $nombre,
                'valor'         => $request->valores[$i],
                'movimiento_id' => $movimiento->id,
            ]);
        }

        // Registrar la ofrenda si existe
        if ($ofrenda > 0) {
            Diezmo::create([
                'fecha'         => $fecha,
                'nombre'        => 'Ofrenda',
                'valor'         => $ofrenda,
                'movimiento_id' => $movimiento->id,
            ]);
        }

        return redirect()->route('libro.index')->with('success', 'Diezmos y ofrenda registrados correctamente.');
    }
}
