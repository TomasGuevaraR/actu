<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Miembro;
use Carbon\Carbon;

class PerfilController extends Controller
{
    public function edit()
    {
        $usuario = Auth::user();
        $miembro = Miembro::where('numero_identificacion', $usuario->numero_identificacion)->first();

        return view('mi_perfil.editar', compact('usuario', 'miembro'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            // Validaciones para User
            'nombre' => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed', // ✔ validación de nueva contraseña

            // Validaciones para Miembro
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'direccion' => 'nullable|string|max:255',
            'barrio' => 'nullable|string|max:255',
        ]);

        // Datos base del usuario
        $dataUsuario = [
            'nombre' => $request->nombre,
            'numero_identificacion' => $request->numero_identificacion,
            'email' => $request->email,
            'rol' => $usuario->rol, // mantener rol actual
        ];

        // Si se quiere cambiar la contraseña
        if ($request->filled('password')) {
            $dataUsuario['password'] = Hash::make($request->password);
        }

        $usuario->update($dataUsuario);

        // Buscar Miembro
        $miembro = Miembro::where('numero_identificacion', $usuario->numero_identificacion)->first();

        if ($miembro) {
            // Calcular edad si hay fecha de nacimiento
            $edad = null;
            if ($request->filled('fecha_nacimiento')) {
                $edad = Carbon::parse($request->fecha_nacimiento)->age;
            }

            $miembro->update([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'edad' => $edad,
                'direccion' => $request->direccion,
                'barrio' => $request->barrio,
                'estado' => $miembro->estado, // mantener estado actual
            ]);
        }

        return redirect()->back()->with('success', 'El perfil fue actualizado.');


    }

    public function getUsuarioJson($id)
    {
        $usuario = User::findOrFail($id);
        return response()->json($usuario);
    }
}
