<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProfileComplete
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
    
        if ($user && !$user->profile) {
            // Cek kalau request bukan ke halaman lengkapin profile dan bukan logout
            if (!$request->is('completeprofile/traineeprofile') && !$request->is('logout')) {
                return redirect()->route('profile.complete');
            }
        }
    
        return $next($request);
    }
}    
