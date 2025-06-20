<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MealPlan;
use App\Models\ProgressSubmission;
use App\Models\User;
use App\Models\TraineeProfile; // Import TraineeProfile

class TraineeMealplanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user(); // Ini adalah objek User yang sedang login

        // Pastikan user memiliki traineeProfile dan trainer_id
        if (!$user->traineeProfile || empty($user->trainer_id)) {
            return redirect('/dashboard')->with('error', 'Profil trainee tidak ditemukan atau Anda belum memiliki trainer.');
        }

        $trainerId = $user->trainer_id;
        $loggedInTraineeProfileId = $user->traineeProfile->id; // <-- BERUBAH: Menggunakan trainee_profiles.id

        // Ambil meal plan untuk trainee login dari trainer yang dipilih, dan untuk hari ini
        $meals = MealPlan::where('trainee_id', $loggedInTraineeProfileId) // <-- BERUBAH: Query dengan trainee_profiles.id
            ->where('trainer_id', $trainerId)
            ->whereDate('date', today())
            ->orderBy('time')
            ->get();

        // Ambil semua submission meal plan yang sudah dilakukan oleh trainee hari ini
        $submittedMeals = ProgressSubmission::where('trainee_id', $loggedInTraineeProfileId) // <-- BERUBAH: Query dengan trainee_profiles.id
            ->whereNotNull('meal_id') // Pastikan hanya submission meal plan
            ->whereDate('submitted_at', today())
            ->get();

        // Buat array asosiatif (meal_id => ProgressSubmission object) untuk memudahkan pencarian di view
        $submittedMealIds = [];
        foreach ($submittedMeals as $submission) {
            $submittedMealIds[$submission->meal_id] = $submission->id;
        }

        return view('trainee.mealplan', compact('meals', 'submittedMealIds'));
    }
}