<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\LibroContable;
use Illuminate\Support\Facades\DB;

class LibroController extends Controller
{

    public function index()
{
    $libro = LibroContable::where('estado', 'activo')->first();

    if (!$libro) {
        return back()->with('error', 'No hay libro contable activo.');
    }

    $movimientos = DB::table('movimientos')
        ->select(
            DB::raw('COALESCE(grupo_id, id) as grupo'),
            DB::raw('MIN(fecha) as fecha'),
            DB::raw('MAX(consecutivo) as consecutivo'),
            DB::raw('MIN(detalle) as detalle'),
            DB::raw('MIN(concepto) as concepto'),
            DB::raw('MIN(tipo) as tipo'),
            DB::raw('GROUP_CONCAT(casilla ORDER BY id) as casillas'),
            DB::raw('SUM(valor) as total_valor')
        )
        ->where('libro_contable_id', $libro->id)
        ->groupBy(DB::raw('COALESCE(grupo_id, id)'))
        ->orderBy('fecha', 'asc')
        ->get();

    return view('libro.index', compact('libro', 'movimientos'));
}



    public function crearIngreso()
    {
        return view('ingresos.create');
    }

    public function crearEgreso()
    {
        return view('egresos.create');
    }

    public function verDiezmos()
    {
        return view('diezmo.index');
    }
}