<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsKepaladinas
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login'); // Belum login
        }

        if (Auth::user()->role->role_name !== 'kepaladinas') {
            abort(403, 'Hanya kepala yang bisa mengakses halaman ini.');
        }

        return $next($request);
    }
}
