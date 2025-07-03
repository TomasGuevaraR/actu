<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Miembro;

class MiembroController extends Controller
{
    public function index()
    {
        $miembros = Miembro::all();
        return view('miembros.index', compact('miembros'));
    }

    public function create()
    {
        return view('miembros.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'numero_identificacion' => 'required|unique:miembros,numero_identificacion',
            'email' => 'nullable|email',
            'telefono' => 'nullable',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer',
            'direccion' => 'nullable',
            'barrio' => 'nullable',
            'estado' => 'nullable|string',
        ]);

        Miembro::create($validated);

        return redirect()->route('miembros.index')->with('success', 'Miembro creado correctamente.');
    }

    public function edit($id)
    {
        $miembro = Miembro::findOrFail($id);
        return view('miembros.edit', compact('miembro'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'numero_identificacion' => 'required|unique:miembros,numero_identificacion,' . $id,
            'email' => 'nullable|email',
            'telefono' => 'nullable',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer',
            'direccion' => 'nullable',
            'barrio' => 'nullable',
            'estado' => 'nullable|string',
        ]);

        $miembro = Miembro::findOrFail($id);
        $miembro->update($validated);

        return redirect()->route('miembros.index')->with('success', 'Miembro actualizado correctamente.');
    }

    public function destroy($id)
    {
        $miembro = Miembro::findOrFail($id);
        $miembro->delete();

        return redirect()->route('miembros.index')->with('success', 'Miembro eliminado correctamente.');
    }

    // ✅ Exportar datos como archivo CSV con separación por punto y coma
    public function exportCsv()
    {
        $fileName = 'miembros.csv';
        $miembros = Miembro::all();

        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['ID', 'Nombres', 'Apellidos', 'Número de Identificación', 'Email', 'Teléfono', 'Fecha de Nacimiento', 'Edad', 'Dirección', 'Barrio', 'Estado'];

        $callback = function () use ($miembros, $columns) {
            $file = fopen('php://output', 'w');

            // BOM para Excel en UTF-8
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Escribir encabezados
            fputcsv($file, $columns, ';');

            // Escribir datos
            foreach ($miembros as $miembro) {
                fputcsv($file, [
                    $miembro->id,
                    $miembro->nombres,
                    $miembro->apellidos,
                    $miembro->numero_identificacion,
                    $miembro->email,
                    $miembro->telefono,
                    $miembro->fecha_nacimiento,
                    $miembro->edad,
                    $miembro->direccion,
                    $miembro->barrio,
                    $miembro->estado
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function show($id)
{
    $miembro = \App\Models\Miembro::find($id);

    if (!$miembro) {
        return response()->json(['error' => 'Miembro no encontrado'], 404);
    }

    return response()->json($miembro);
}


}
