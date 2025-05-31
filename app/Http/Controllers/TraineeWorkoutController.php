<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Workout;

class TraineeWorkoutController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Dapatkan user yang login (trainee)

        // Ambil workout berdasarkan trainee_id dan urutkan berdasarkan tanggal
        $workouts = Workout::where('trainee_id', $user->id)
            ->orderBy('date')
            ->get()
            ->groupBy('day');

        return view('trainee.workout', [
            'traineeName' => $user->name, // Kirim nama trainee ke view
            'workouts' => $workouts
        ]);
    }
}
