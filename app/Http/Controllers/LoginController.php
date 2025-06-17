<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('loginregis.login'); // sesuaikan dengan path view login kamu
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:trainer,trainee',
        ]);// Simpan ke database

        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ])) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Periksa role
            if ($user->role !== $credentials['role']) {
                Auth::logout();
                return back()->withErrors(['role' => 'Incorrect role selected.']);
            }

            // Jika trainer dan belum isi profil
            if ($user->role === 'trainer' && !$user->profile_completed) {
                return redirect()->route('trainer.profile.complete');
            }

            // Jika trainee dan belum isi profil
            if ($user->role === 'trainee' && !$user->profile_completed) {
                return redirect()->route('trainee.profile.complete');
            }

            // Jika profil sudah lengkap
            return redirect()->route($user->role . '.home');
        }

        return back()->withErrors([
            'username' => 'Invalid credentials.',
        ])->onlyInput('username');
    }
}
