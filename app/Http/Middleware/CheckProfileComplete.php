<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProfileComplete
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user->role === 'trainer' && !$user->profile_completed) {
            return redirect()->route('trainer.profile.complete');
        }

        if ($user->role === 'trainee' && !$user->profile_completed) {
            return redirect()->route('trainee.profile.complete');
        }

        return $next($request);
    }
}
