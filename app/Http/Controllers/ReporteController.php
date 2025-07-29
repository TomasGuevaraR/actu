<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = Reporte::latest()->get();
        return view('reportes.index', compact('reportes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'autor' => 'required|string|max:100',
        ]);

        Reporte::create($request->all());

        return redirect()->back()->with('success', 'Reporte creado correctamente');
    }

    public function destroy($id)
    {
        Reporte::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Reporte eliminado');
    }
}
