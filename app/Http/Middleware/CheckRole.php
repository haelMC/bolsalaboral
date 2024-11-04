<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener el rol del usuario logueado
            $userRole = Auth::user()->role_id; // Asumiendo que usas role_id en tu tabla de usuarios

            // Convertir roles a IDs y verificar si el rol del usuario está permitido
            $allowedRoles = [
                'admin' => 3,     // Ajusta los valores de acuerdo a tu base de datos
                'empresa' => 2,
                'usuario' => 1,
            ];

            if (in_array($userRole, array_intersect_key($allowedRoles, array_flip($roles)))) {
                return $next($request);
            }
        }

        // Si el usuario no tiene acceso, redirigir a una página o lanzar un error
        return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
