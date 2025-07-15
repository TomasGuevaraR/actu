<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;

class MovimientoController extends Controller
{
    public function edit($id)
    {
        $movimiento = Movimiento::findOrFail($id);
        return view('movimientos.edit', compact('movimiento'));
    }

    public function update(Request $request, $id)
    {
        $movimiento = Movimiento::findOrFail($id);

        $request->validate([
            'fecha' => 'required|date',
            'consecutivo' => 'nullable|string',
            'detalle' => 'required|string',
            'concepto' => 'required|string',
            'casilla' => 'nullable|string',
            'valor' => 'required|numeric|min:0',
        ]);

        $movimiento->update($request->only(['fecha', 'consecutivo', 'detalle', 'concepto', 'casilla', 'valor']));

        return redirect()->route('libro.index')->with('success', 'Movimiento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $movimiento = Movimiento::findOrFail($id);
        $movimiento->delete();

        return redirect()->route('libro.index')->with('success', 'Movimiento eliminado correctamente.');
    }
}
