<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CheckRol
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->rol, $roles)) {
            return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción.');
        }

        return $next($request);
    }
}
