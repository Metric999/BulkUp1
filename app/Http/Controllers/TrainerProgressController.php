<?php

namespace App\Http\Controllers;

use App\Models\TraineeProfile;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgressSubmission;

class TrainerProgressController extends Controller
{
    public function index()
    {
        $trainerId = auth()->user()->id;

        // Ambil semua trainee yang dimiliki oleh trainer
        $trainees = TraineeProfile::with(['user', 'progressSubmissions'])
            ->where('trainer_id', $trainerId)
            ->get();

        // Olah data trainee satu per satu
        $data = $trainees->map(function ($trainee) {
            $mealplanDone = $trainee->progressSubmissions
                ->whereNotNull('meal_id')
                ->count();

            $workoutDone = $trainee->progressSubmissions
                ->whereNotNull('workout_id')
                ->count();

            // Alternatif: hitung ulang dari database jika perlu lebih akurat
            $workoutDoneCount = ProgressSubmission::where('trainee_id', $trainee->id)
                ->whereNotNull('workout_id')
                ->count();

            $lastSubmit = optional(
                $trainee->progressSubmissions->sortByDesc('created_at')->first()
            )->created_at;

            return [
                'id' => $trainee->id,
                'name' => $trainee->user->username ?? 'Trainee',
                'mealplan_done' => $mealplanDone,
                'workout_done' => $workoutDone, // atau ganti ke $workoutDoneCount jika mau yang dari DB
                'last_submit' => $lastSubmit ? $lastSubmit->format('d M Y H:i') : '-',
                'workout_done_count' => $workoutDoneCount // tambahkan jika mau tampilkan
            ];
        });

        return view('trainer.progress', ['trainees' => $data]);
    }
}
