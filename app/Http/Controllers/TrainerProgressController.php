<?php

namespace App\Http\Controllers;

use App\Models\TraineeProfile;
use App\Models\Workout;
use App\Models\MealPlan;
use App\Models\ProgressSubmission;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Laravel\Prompts\Progress;

// Simpan ke database
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

        // dd($trainee->user->id);

        // $workoutDone = $trainee->progressSubmissions()->count();
        $workoutDone = ProgressSubmission::where('trainee_id', $trainee->user->id)->count();

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