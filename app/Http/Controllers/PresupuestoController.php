<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presupuesto;

class PresupuestoController extends Controller
{
    /**
     * Mostrar todos los presupuestos filtrados por año.
     */
    public function index(Request $request)
    {
        $año = $request->get('año', now()->year); // Año actual por defecto
        $presupuestos = Presupuesto::with('movimientos')
                            ->where('año', $año)
                            ->orderBy('nombre_casilla')
                            ->get();

        return view('presupuestos.index', compact('presupuestos', 'año'));
    }

    /**
     * Mostrar formulario para crear nuevo presupuesto.
     */
    public function create()
    {
        return view('presupuestos.create');
    }

    /**
     * Guardar un nuevo presupuesto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_casilla'   => 'required|string|max:255',
            'categoria'        => 'required|string|max:255',
            'valor_mensual'    => 'required|numeric|min:0',
            'año'              => 'required|digits:4|integer|min:2024',
            'responsable'      => 'nullable|string|max:255',
        ]);

        Presupuesto::create([
            'nombre_casilla'   => $request->nombre_casilla,
            'categoria'        => $request->categoria,
            'valor_mensual'    => $request->valor_mensual,
            'año'              => $request->año,
            'responsable'      => $request->responsable,
        ]);

        return redirect()->route('presupuestos.index')
                        ->with('success', 'Presupuesto creado correctamente.');
    }

    /**
     * Mostrar un presupuesto específico.
     */
    public function show($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        return view('presupuestos.show', compact('presupuesto'));
    }

    /**
     * Mostrar formulario para editar un presupuesto.
     */
    public function edit($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        return view('presupuestos.edit', compact('presupuesto'));
    }

    /**
     * Actualizar un presupuesto existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_casilla'   => 'required|string|max:255',
            'categoria'        => 'required|string|max:255',
            'valor_mensual'    => 'required|numeric|min:0',
            'año'              => 'required|digits:4|integer|min:2024',
            'responsable'      => 'nullable|string|max:255',
        ]);

        $presupuesto = Presupuesto::findOrFail($id);
        $presupuesto->update($request->all());

        return redirect()->route('presupuestos.index')
                        ->with('success', 'Presupuesto actualizado correctamente.');
    }

    /**
     * Eliminar un presupuesto.
     */
    public function destroy($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $presupuesto->delete();

        return redirect()->route('presupuestos.index')
                        ->with('success', 'Presupuesto eliminado correctamente.');
    }
}
