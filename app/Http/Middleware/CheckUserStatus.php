<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Si el status del usuario es 0 (pendiente), redirigirlo a una página de espera
            if (Auth::user()->status == 0) {
                // Verificar si el guard actual es el basado en sesiones (web)
                if (Auth::guard('web')->check()) {
                    Auth::guard('web')->logout();  // Deslogear al usuario solo si es el guard 'web'
                }
                
                // Redirigir al usuario a la página de cuenta pendiente de aprobación
                return redirect()->route('pending.approval')  // Cambia esto por tu ruta de espera resources/views/auth/pending-approval.blade.php
                    ->with('error', 'Tu cuenta está pendiente de aprobación.');
            }
        }

        return $next($request);
    }
}
