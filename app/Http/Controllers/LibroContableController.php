<?php

namespace App\Http\Controllers;

use App\Models\LibroContable;
use App\Models\LibroContableEstado;
use Illuminate\Http\Request;
use App\Models\Movimiento;
use Carbon\Carbon;

class LibroContableController extends Controller
{
    /**
     * Mostrar el libro actual y sus movimientos.
     */
    public function index()
    {
        $rolUsuario = auth()->guard('web')->user()->rol ?? '';

        // Trae el libro contable más reciente
        $libroActual = LibroContable::latest()->first();

        // Si no existe ningún libro, crear automáticamente Enero 2025
        if (!$libroActual) {
            $estadoAbierto = LibroContableEstado::where('nombre', 'Abierto')->first();

            $libroActual = LibroContable::create([
                'nombre'         => 'Enero 2025',
                'mes_libro'      => 1,
                'anio_libro'     => 2025,
                'estado_id'      => $estadoAbierto->id,
                'monto'          => 0,
            ]);
        }

        // Cargar los movimientos de ese libro
        $movimientos = Movimiento::where('libro_contable_id', $libroActual->id)->get();

        return view('libro.index', compact('rolUsuario', 'movimientos', 'libroActual'));
    }

    /**
     * Cerrar libro (tesorero).
     */
    public function cerrar($id)
    {
        $libro = LibroContable::findOrFail($id);
        $estadoAbierto = LibroContableEstado::where('nombre', 'Abierto')->first();
        $estadoCerrado = LibroContableEstado::where('nombre', 'Cerrado')->first();

        if ($libro->estado_id != $estadoAbierto->id) {
            return redirect()->back()->with('error', 'Solo se puede cerrar un libro que esté abierto.');
        }

        // Cerrar libro actual
        $libro->estado_id = $estadoCerrado->id;
        $libro->save();

        // Crear siguiente libro automáticamente
        $siguienteMes = $libro->mes_libro + 1;
        $siguienteAnio = $libro->anio_libro;

        if ($siguienteMes > 12) {
            $siguienteMes = 1;
            $siguienteAnio++;
        }

        $estadoAbierto = LibroContableEstado::where('nombre', 'Abierto')->first();

        LibroContable::create([
            'nombre'         => Carbon::create($siguienteAnio, $siguienteMes, 1)
                                    ->locale('es')
                                    ->translatedFormat('F Y'),
            'mes_libro'      => $siguienteMes,
            'anio_libro'     => $siguienteAnio,
            'estado_id'      => $estadoAbierto->id,
            'monto'          => 0,
        ]);

        return redirect()->back()->with('success', 'El libro contable se cerró y se abrió automáticamente el siguiente.');
    }

    /**
     * Aprobar libro (pastor/fiscal).
     */
    public function aprobar($id)
    {
        $libro = LibroContable::findOrFail($id);
        $estadoCerrado = LibroContableEstado::where('nombre', 'Cerrado')->first();
        $estadoAprobado = LibroContableEstado::where('nombre', 'Aprobado')->first();

        if ($libro->estado_id != $estadoCerrado->id) {
            return redirect()->back()->with('error', 'Solo se puede aprobar un libro que esté cerrado.');
        }

        $libro->estado_id = $estadoAprobado->id;
        $libro->save();

        return redirect()->back()->with('success', 'El libro contable se aprobó correctamente.');
    }

    /**
     * Rechazar libro (pastor/fiscal).
     */
    public function rechazar($id)
    {
        $libro = LibroContable::findOrFail($id);
        $estadoAbierto = LibroContableEstado::where('nombre', 'Abierto')->first();

        // Vuelve a abierto para que el tesorero pueda corregir
        $libro->estado_id = $estadoAbierto->id;
        $libro->save();

        return redirect()->back()->with('success', 'El libro contable fue rechazado y reabierto para corrección.');
    }
}
