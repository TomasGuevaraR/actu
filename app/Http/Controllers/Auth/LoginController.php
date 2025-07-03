<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    /**
     * Maneja el intento de inicio de sesión.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Buscar el usuario por email
        $usuario = Usuario::where('email', $credentials['email'])->first();

        // Validar si el usuario existe
        if (!$usuario) {
            return back()->withErrors([
                'email' => 'El usuario no está registrado.',
            ])->onlyInput('email');
        }

        // Validar si el usuario está activo
        if ($usuario->estado !== 'activo') {
            return back()->withErrors([
                'email' => 'Tu cuenta está inactiva. Contacta al administrador.',
            ])->onlyInput('email');
        }

        // Validar la contraseña
        if (!Hash::check($credentials['password'], $usuario->password)) {
            return back()->withErrors([
                'email' => 'Las credenciales son incorrectas.',
            ])->onlyInput('email');
        }

        // Autenticar
        Auth::login($usuario, $request->filled('remember'));
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
