<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TraineeWorkoutController extends Controller
{
    public function index(Request $request)
    {
        // Simulasi trainee yang login
        $traineeId = "1"; // Di project nyata, ganti dengan auth()->id()
        $traineeName = "Andre"; // Di project nyata, ganti dengan auth()->user()->name

        $daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

        // Ambil workout dari session Laravel (bukan PHP native)
        $workouts = session("workouts.$traineeId", []);

        return view('trainee.workout', compact('traineeId', 'traineeName', 'daysOfWeek', 'workouts'));
    }
}
