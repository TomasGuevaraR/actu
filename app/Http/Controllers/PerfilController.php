<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PerfilController extends Controller
{
    public function edit()
    {
        $usuario = Auth::user();
        return view('mi_perfil.editar', compact('usuario'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'direccion' => 'nullable|string|max:255',
            'alias' => 'nullable|string|max:50',
            'estado' => 'nullable|in:ACTIVO,DESACTIVADO',
            'barrio' => 'nullable|string|max:255',
            'rol' => 'nullable|in:pastor,ancianos,fiscal,tesorero,secretario',
        ]);

        $usuario->update($request->only([
            'nombres',
            'apellidos',
            'numero_identificacion',
            'email',
            'telefono',
            'fecha_nacimiento',
            'direccion',
            'alias',
            'estado',
            'barrio',
            'rol',
        ]));

        return redirect()->route('mi-perfil.index')->with('success', 'Perfil actualizado correctamente.');
    }

    public function getUsuarioJson($id)
    {
        $usuario = User::findOrFail($id);
        return response()->json($usuario);
    }
}
