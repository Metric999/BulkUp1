<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TraineeProfile;
use App\Models\ProgressSubmission;
use App\Models\MealPlan;
use App\Models\Workout; // Pastikan model ini di-import
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
            // Redirect jika profil trainee belum lengkap
            return redirect()->route('trainee.profile.complete')->with('warning', 'Please complete your profile first.');
        }

        // Data untuk BMI Calculator
        $gender = $request->old('gender', $traineeProfile->gender);
        $weight = $request->old('weight', $traineeProfile->weight);
        $age = $request->old('age', $traineeProfile->age);
        $height = $request->old('height', $traineeProfile->height);
        $bmiResult = null;
        $bmiCategory = '';

        // Jika ada data BMI yang di-submit
        if ($request->isMethod('post')) {
            $bmiData = $this->calculateBMI($request);
            $bmiResult = $bmiData['bmiResult'];
            $bmiCategory = $bmiData['bmiCategory'];
        }

        // Data untuk Progress
        // Menggunakan trainee_profiles.id untuk query ke progress_submissions
        $traineeProfileId = $traineeProfile->id;

        $mealplanDoneCount = ProgressSubmission::where('trainee_id', $traineeProfileId)
            ->whereNotNull('meal_id')
            ->count();

        $workoutDoneCount = ProgressSubmission::where('trainee_id', $traineeProfileId)
            ->whereNotNull('workout_id')
            ->count();

        // Tentukan tab aktif (default 'progressTab')
        $activeTab = $request->query('tab', 'progressTab');

        return view('trainee.home', compact(
            'gender', 'weight', 'age', 'height', 'bmiResult', 'bmiCategory',
            'mealplanDoneCount', 'workoutDoneCount', 'activeTab'
        ));
    }

    /**
     * Menghitung BMI (method yang sudah ada)
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

        // Update trainee profile with new BMI data
        $traineeProfile = Auth::user()->traineeProfile;
        if ($traineeProfile) {
            $traineeProfile->update([
                'gender' => $request->gender,
                'weight' => $request->weight,
                'age' => $request->age,
                'height' => $request->height,
                // Anda bisa menyimpan BMI result dan category jika ada kolomnya di TraineeProfile
            ]);
        }

        return [
            'bmiResult' => $bmi,
            'bmiCategory' => $category,
        ];
    }

    /**
     * Mengambil daftar meal plan yang sudah disubmit oleh trainee.
     * Dipanggil melalui AJAX.
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
            ->pluck('meal_id'); // Ambil hanya ID meal plan yang sudah disubmit

        $submittedMealPlans = MealPlan::whereIn('id', $submittedMealPlanIds)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return response()->json($submittedMealPlans);
    }

    /**
     * Mengambil daftar workout yang sudah disubmit oleh trainee.
     * Dipanggil melalui AJAX.
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
            ->pluck('workout_id'); // Ambil hanya ID workout yang sudah disubmit

        // Mengambil detail workout. Eloquent secara default akan mengambil semua kolom,
        // jadi kategori, difficulty, dan reps seharusnya sudah ada jika ada di tabel.
        $submittedWorkouts = Workout::whereIn('id', $submittedWorkoutIds)
            ->orderBy('date', 'desc') // Asumsi model Workout memiliki kolom 'date'
            ->get();

        return response()->json($submittedWorkouts);
    }
}