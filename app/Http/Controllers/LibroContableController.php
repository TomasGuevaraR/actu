<?php

namespace App\Http\Controllers;

use App\Models\LibroContable;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibroContableController extends Controller
{
    public function index()
    {
        $rolUsuario = Auth::user()->rol ?? 'sin-rol';

        // Si es secretario, mostrar mensaje de no permisos
        if ($rolUsuario === 'secretario') {
            return view('libro.index', compact('rolUsuario'));
        }

        // Buscar libro con estado 'activo'
        $libroActual = LibroContable::where('estado', 'activo')
            ->orderBy('anio_libro', 'desc')
            ->orderBy('mes_libro', 'desc')
            ->first();

        // Si no hay libro activo, buscar el último libro
        if (!$libroActual) {
            $libroActual = LibroContable::orderBy('anio_libro', 'desc')
                ->orderBy('mes_libro', 'desc')
                ->first();
        }

        // Si no existe ningún libro, crear uno nuevo
        if (!$libroActual) {
            $libroActual = LibroContable::create([
                'nombre'     => 'Enero ' . date('Y'),
                'mes_libro'  => 1,
                'anio_libro' => date('Y'),
                'estado'     => 'activo',
                'monto'      => 0,
            ]);
        }

        // Obtener movimientos del libro actual
        $movimientos = $libroActual->movimientos()->get();

        return view('libro.index', compact('rolUsuario', 'libroActual', 'movimientos'));
    }

    public function aprobar($id)
    {
        $libro = LibroContable::findOrFail($id);
        $libro->estado = 'aprobado';
        $libro->save();

        return redirect()->route('libro.index')->with('success', 'Libro aprobado correctamente.');
    }

    public function rechazar($id)
    {
        $libro = LibroContable::findOrFail($id);
        $libro->estado = 'activo';
        $libro->save();
        

        return redirect()->route('libro.index')->with('success', 'Libro rechazado y reabierto para corrección.');
    }
}