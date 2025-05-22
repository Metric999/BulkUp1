<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraineeProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil data user yang login
        $profile = $user->profile; // Asumsikan ada relasi 'profile' pada model User

        return view('trainee.profile', compact('user', 'profile'));
    }
}
