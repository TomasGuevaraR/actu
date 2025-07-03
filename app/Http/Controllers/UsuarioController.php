<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Guarda un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        
        // Validación de los campos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:20|unique:usuarios,numero_identificacion',
            'email' => 'required|email|max:255|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
            'rol' => 'required|in:pastor,anciano,tesorero,fiscal,secretario',
            'estado' => 'nullable|in:activo,inactivo',
        ]);

        // Crear el nuevo usuario
        Usuario::create([
            'nombre' => $request->nombre,
            'numero_identificacion' => $request->numero_identificacion,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'estado' => $request->estado ?? 'activo',
        ]);

        return redirect()->route('usuarios.index')
                        ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Muestra la lista de usuarios.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }
public function toggle($id)
{
    $usuario = Usuario::findOrFail($id);
    $usuario->estado = $usuario->estado === 'activo' ? 'inactivo' : 'activo';
    $usuario->save();

    return redirect()->route('usuarios.index')->with('success', 'El estado del usuario ha sido actualizado.');
}


}

