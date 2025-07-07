<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;

class LibroController extends Controller
{
    /**
     * Muestra todos los movimientos del libro contable.
     */
    public function index()
    {
        $movimientos = Movimiento::orderBy('fecha', 'desc')->get(); // o usa paginate()

        return view('libro.index', compact('movimientos'));
    }

    /**
     * Muestra el formulario para crear un ingreso.
     */
    public function crearIngreso()
    {
        return view('ingresos.create');
    }

    /**
     * Muestra el formulario para crear un egreso.
     */
    public function crearEgreso()
    {
        return view('egresos.create');
    }

    /**
     * Muestra el listado de diezmos y ofrendas.
     */
    public function verDiezmos()
    {
        return view('diezmo.index');
    }
}
