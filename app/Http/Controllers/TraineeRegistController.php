<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TraineeRegistController extends Controller
{
    public function showForm()
    {
        return view('/loginregis.TraineeRegist');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'trainee', // <-- pastikan kolom role tersedia di tabel users
            'profile_completed' => false // <-- opsional, untuk middleware check.profile.complete
        ]);

        return redirect()->route('login.form')->with('success', 'Trainee registration successful. Please log in.');
    }
}
