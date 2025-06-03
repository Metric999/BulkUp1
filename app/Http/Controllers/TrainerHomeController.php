<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerProfile;
use App\Models\TraineeProfile;
use App\Models\Workout;
use App\Models\MealPlan;
use Illuminate\Support\Facades\Auth;

class TrainerHomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $trainer = TrainerProfile::where('user_id', $user->id)->first();

        if (!$trainer) {
            return redirect()->route('complete-profile')->with('error', 'Please complete your trainer profile first.');
        }

        $trainees = TraineeProfile::where('trainer_id', $trainer->user_id)->get();
        $totalWorkoutPlans = Workout::where('trainer_id', $trainer->user_id)->count();
        $totalMealPlans = MealPlan::where('trainer_id', $trainer->user_id)->count();

        return view('trainer.home', [
            'trainerName' => $trainer->name,
            'trainees' => $trainees,
            'totalTrainees' => $trainees->count(),
            'totalWorkoutPlans' => $totalWorkoutPlans,
            'totalMealPlans' => $totalMealPlans
        ]);
    }
}
