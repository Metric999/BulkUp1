<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsTrainee
{
    public function handle(Request $request, Closure $next)
    {
    if (Auth::check() && Auth::user()->role === 'trainee') {
        return $next($request);
    }

    abort(403, 'Akses ditolak. Bukan trainee.');
    }

}
