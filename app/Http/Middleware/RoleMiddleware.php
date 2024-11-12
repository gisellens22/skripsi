<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role_id == $role) {
            return $next($request);
        }

        // Jika tidak, redirect atau tampilkan error
        return redirect('/home')->with('error', 'You do not have access to this section.');
    }
}
