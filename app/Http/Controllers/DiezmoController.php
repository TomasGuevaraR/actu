<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diezmo;
use App\Models\Movimiento;
use App\Models\Miembro;
use App\Models\LibroContable;
use Carbon\Carbon;

class DiezmoController extends Controller
{
    public function index()
    {
        $miembros = Miembro::selectRaw("CONCAT(nombres, ' ', apellidos) as nombre_completo")->pluck('nombre_completo');
        
        // 🔹 Obtener el libro contable activo para las fechas
        $libroActivo = LibroContable::where('estado', 'activo')->first();
        
        return view('diezmo.index', compact('miembros', 'libroActivo'));
    }

    public function create()
    {
        $miembros = Miembro::all();
        $libroActivo = LibroContable::where('estado', 'activo')->first();
        return view('diezmo.index', compact('miembros', 'libroActivo'));
    }

    public function store(Request $request)
    {
        // 🔹 Buscar el libro contable activo primero
        $libro = LibroContable::where('estado', 'activo')->first();

        if (!$libro) {
            return redirect()->back()->with('error', 'No hay un libro contable activo. Activa un libro para poder registrar diezmos.');
        }

        // 🔹 Calcular fechas basándose en mes_libro y anio_libro
        $fechaInicio = Carbon::createFromDate($libro->anio_libro, $libro->mes_libro, 1)->startOfMonth();
        $fechaFin = Carbon::createFromDate($libro->anio_libro, $libro->mes_libro, 1)->endOfMonth();
        
        $request->validate([
            'fecha'     => [
                'required',
                'date',
                'after_or_equal:' . $fechaInicio->format('Y-m-d'),
                'before_or_equal:' . $fechaFin->format('Y-m-d')
            ],
            'detalle'   => 'required|string',
            'concepto'  => 'required|string',
            'nombres'   => 'required|array',
            'nombres.*' => 'required|string',
            'valores'   => 'required|array',
            'valores.*' => 'required|numeric|min:0',
            'ofrenda'   => 'nullable|numeric|min:0',
        ], [
            // 🔹 Mensaje personalizado para la validación de fecha
            'fecha.after_or_equal' => 'La fecha debe estar entre ' . $fechaInicio->format('d/m/Y') . ' y ' . $fechaFin->format('d/m/Y') . ' (rango del libro activo: ' . $libro->nombre . ')',
            'fecha.before_or_equal' => 'La fecha debe estar entre ' . $fechaInicio->format('d/m/Y') . ' y ' . $fechaFin->format('d/m/Y') . ' (rango del libro activo: ' . $libro->nombre . ')',
        ]);

        $fecha = $request->fecha;
        $detalle = $request->detalle;
        $concepto = $request->concepto;
        $ofrenda = $request->ofrenda ?? 0;
        $totalDiezmos = array_sum($request->valores);
        $totalGeneral = $totalDiezmos + $ofrenda;

        // 🔹 Obtener saldo anterior dentro del mismo libro
        $ultimoMovimiento = Movimiento::where('libro_contable_id', $libro->id)->latest('id')->first();
        $saldoAnterior = $ultimoMovimiento ? $ultimoMovimiento->saldo : 0;
        $nuevoSaldo = $saldoAnterior + $totalGeneral;

        // 🔹 Crear movimiento general vinculado al libro contable
        $movimiento = Movimiento::create([
            'fecha'             => $fecha,
            'detalle'           => $detalle,
            'concepto'          => $concepto,
            'valor'             => $totalGeneral,
            'tipo'              => 'ingreso',
            'saldo'             => $nuevoSaldo,
            'libro_contable_id' => $libro->id,  // 👈 se agrega
        ]);

        // 🔹 Registrar los diezmos individuales
        foreach ($request->nombres as $i => $nombre) {
            Diezmo::create([
                'fecha'         => $fecha,
                'nombre'        => $nombre,
                'valor'         => $request->valores[$i],
                'movimiento_id' => $movimiento->id,
            ]);
        }

        // 🔹 Registrar la ofrenda si existe
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