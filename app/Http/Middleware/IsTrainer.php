<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsTrainer
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'trainer') {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Bukan trainer.');
    }
}
