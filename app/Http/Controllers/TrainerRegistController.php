<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
// Simpan ke database
class TrainerRegistController extends Controller
{
    // Tampilkan form registrasi trainer
    public function showForm()
    {
        if (!session('is_trainer')) {
            return redirect()->route('trainer.invite.show')->withErrors(['msg' => 'Unauthorized access.']);
        }

        return view('loginregis.TrainerRegist'); // pastikan file blade sesuai
    }

    // Proses registrasi trainer
    // TrainerRegistController.php

public function register(Request $request)
{
    if (!session('is_trainer')) {
        return redirect()->route('trainer.invite.show')->withErrors(['msg' => 'Unauthorized access.']);
    }

    $validated = $request->validate([
        'username' => 'required|string|unique:users,username',
        'password' => 'required|string|min:6',
        'email' => 'required|email|unique:users,email',
    ]);

    $user = User::create([
        'username' => $validated['username'],
        'password' => Hash::make($validated['password']),
        'email' => $validated['email'],
        'role' => 'trainer',
    ]);

    $request->session()->forget('is_trainer');

    // Jangan auto-login
    // Auth::login($user);

    // Redirect ke login page
    return redirect()->route('login.form')->with('success', 'Registration successful! Please login to continue.');
}

}
