<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role->name === $role) {
            return $next($request);
        }

        return redirect('/'); // Redirige si no tiene el rol adecuado
    }
}