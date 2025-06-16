<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsStaff
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login'); // Belum login
        }

        if (Auth::user()->role->role_name !== 'staff') {
            abort(403, 'Hanya kepala dinas yang bisa mengakses halaman ini.');
        }

        return $next($request);
    }
}
