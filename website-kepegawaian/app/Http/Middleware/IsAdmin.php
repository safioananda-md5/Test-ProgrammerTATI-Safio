<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login'); // Belum login
        }

        if (Auth::user()->role->role_name !== 'admin') {
            abort(403, 'Hanya admin yang bisa mengakses halaman ini.');
        }

        return $next($request);
    }
}
