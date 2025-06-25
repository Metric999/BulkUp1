<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TraineeProfile;
use App\Models\ProgressSubmission;
use App\Models\MealPlan;
use App\Models\Workout;
use Carbon\Carbon;

class TraineeHomeController extends Controller
{
    /**
     * Menampilkan halaman home trainee dengan data BMI dan progress.
     */
    public function showHome(Request $request)
    {
        $user = Auth::user();
        $traineeProfile = $user->traineeProfile;

        if (!$traineeProfile) {
            return redirect()->route('trainee.profile.complete')->with('warning', 'Please complete your profile first.');
        }

        // Data default dari profil
        $gender = $request->old('gender', $traineeProfile->gender);
        $weight = $request->old('weight', $traineeProfile->weight);
        $age = $request->old('age', $traineeProfile->age);
        $height = $request->old('height', $traineeProfile->height);
        $bmiResult = null;
        $bmiCategory = '';

        // Hitung BMI jika ada form POST
        if ($request->isMethod('post')) {
            $bmiData = $this->calculateBMI($request);
            $bmiResult = $bmiData['bmiResult'];
            $bmiCategory = $bmiData['bmiCategory'];
        }

        // Hitung jumlah meal dan workout yang disubmit
        $traineeProfileId = $traineeProfile->id;

        $mealplanDoneCount = ProgressSubmission::where('trainee_id', $traineeProfileId)
            ->whereNotNull('meal_id')
            ->count();

        $workoutDoneCount = ProgressSubmission::where('trainee_id', $traineeProfileId)
            ->whereNotNull('workout_id')
            ->count();

        $activeTab = $request->query('tab', 'progressTab');

        return view('trainee.home', compact(
            'gender', 'weight', 'age', 'height', 'bmiResult', 'bmiCategory',
            'mealplanDoneCount', 'workoutDoneCount', 'activeTab'
        ));
    }

    /**
     * Hanya menghitung BMI tanpa menyimpan ke database.
     */
    public function calculateBMI(Request $request)
    {
        $request->validate([
            'gender' => 'required|in:Pria,Wanita',
            'weight' => 'required|numeric|min:1',
            'age' => 'required|integer|min:18',
            'height' => 'required|numeric|min:1',
        ]);

        $heightInMeters = $request->height / 100;
        $bmi = $request->weight / ($heightInMeters * $heightInMeters);
        $bmi = round($bmi, 2);

        $category = '';
        if ($bmi < 18.5) {
            $category = 'Kurus';
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $category = 'Normal';
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            $category = 'Gemuk';
        } else {
            $category = 'Obesitas';
        }

        return [
            'bmiResult' => $bmi,
            'bmiCategory' => $category,
        ];
    }

    /**
     * Mendapatkan daftar meal plan yang disubmit (AJAX).
     */
    public function getSubmittedMealPlans(Request $request)
    {
        $user = Auth::user();
        $traineeProfile = $user->traineeProfile;

        if (!$traineeProfile) {
            return response()->json(['error' => 'Trainee profile not found.'], 404);
        }

        $submittedMealPlanIds = ProgressSubmission::where('trainee_id', $traineeProfile->id)
            ->whereNotNull('meal_id')
            ->pluck('meal_id');

        $submittedMealPlans = MealPlan::whereIn('id', $submittedMealPlanIds)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return response()->json($submittedMealPlans);
    }

    /**
     * Mendapatkan daftar workout yang disubmit (AJAX).
     */
    public function getSubmittedWorkouts(Request $request)
    {
        $user = Auth::user();
        $traineeProfile = $user->traineeProfile;

        if (!$traineeProfile) {
            return response()->json(['error' => 'Trainee profile not found.'], 404);
        }

        $submittedWorkoutIds = ProgressSubmission::where('trainee_id', $traineeProfile->id)
            ->whereNotNull('workout_id')
            ->pluck('workout_id');

        $submittedWorkouts = Workout::whereIn('id', $submittedWorkoutIds)
            ->orderBy('date', 'desc')
            ->get();

        return response()->json($submittedWorkouts);
    }
}
