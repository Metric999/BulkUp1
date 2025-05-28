<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraineeProfileController extends Controller
{
    public function index()
    {
    $user = Auth::user();
    $profile = $user->traineeprofile()->with('trainer')->first();

    return view('trainee.profile', compact('user', 'profile'));
    }
}
