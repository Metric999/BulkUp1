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
        $trainerId = Auth::id();

        // Ambil trainee yang memilih trainer ini
        $trainees = TraineeProfile::where('trainer_id', $trainerId)->get();

        $progress = $trainees->map(function ($trainee) {
            $mealplanCount = MealPlan::where('trainer_id', $trainee->trainer_id)
                                    ->where('trainee_id', $trainee->user_id)
                                    ->count();

            $workoutCount = Workout::where('trainer_id', $trainee->trainer_id)
                                    ->where('trainee_id', $trainee->user_id)
                                    ->count();

            // Ambil tanggal terakhir submit (pakai updated_at dari workout/mealplan)
            $lastWorkout = Workout::where('trainee_id', $trainee->user_id)->latest('updated_at')->first();
            $lastMealplan = MealPlan::where('trainee_id', $trainee->user_id)->latest('updated_at')->first();

            $lastSubmit = collect([$lastWorkout?->updated_at, $lastMealplan?->updated_at])
                ->filter()
                ->sortDesc()
                ->first();

            return [
                'name' => $trainee->name,
                'mealplan_done' => $mealplanCount,
                'workout_done' => $workoutCount,
                'last_submit' => $lastSubmit ? Carbon::parse($lastSubmit)->diffForHumans() : 'Belum ada',
            ];
        });

        return view('trainer.progress', ['trainees' => $progress]);
    }
}
