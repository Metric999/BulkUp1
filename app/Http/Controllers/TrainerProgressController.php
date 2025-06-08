<?php

namespace App\Http\Controllers;

use App\Models\TraineeProfile;
use App\Models\Workout;
use App\Models\MealPlan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrainerProgressController extends Controller
{
    public function index()
{
    $trainerId = auth()->user()->id;

    $trainees = TraineeProfile::with(['user', 'mealPlans', 'progressSubmissions'])
        ->where('trainer_id', $trainerId)
        ->get();

    $data = $trainees->map(function ($trainee) {
        $mealplanDone = $trainee->mealPlans->count();

        $workoutDone = $trainee->progressSubmissions
            ->whereNotNull('workout_id')
            ->unique('workout_id')
            ->count();

        $lastSubmit = optional($trainee->progressSubmissions->sortByDesc('created_at')->first())->created_at;

        return [
            'name' => $trainee->user->username ?? 'Trainee',
            'mealplan_done' => $mealplanDone,
            'workout_done' => $workoutDone,
            'last_submit' => $lastSubmit ? $lastSubmit->format('d M Y H:i') : '-',
        ];
    });

    return view('trainer.progress', ['trainees' => $data]);
    }

}