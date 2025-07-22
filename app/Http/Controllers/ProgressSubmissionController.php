<?php

namespace App\Http\Controllers;

use App\Models\ProgressSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\TraineeProfile; // Import TraineeProfile

class ProgressSubmissionController extends Controller
{
    /**
     * Menyimpan (submit) progress untuk workout atau meal plan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:workout,mealplan',
            'item_id' => 'required|integer'
        ]);

        $user = Auth::user();

        // Pastikan user memiliki traineeProfile
        if (!$user->traineeProfile) {
            return redirect()->back()->with('error', 'Profil trainee tidak ditemukan.');
        }

        $loggedInTraineeProfileId = $user->traineeProfile->id; // <-- BERUBAH: Menggunakan trainee_profiles.id

        $data = [
            'trainee_id' => $loggedInTraineeProfileId, // <-- Sekarang konsisten dengan trainee_profiles.id
            'submitted_at' => now(),
        ];

        if ($request->type === 'workout') {
            $data['workout_id'] = $request->item_id;
            $data['meal_id'] = null;
        } else { // type === 'mealplan'
            $data['meal_id'] = $request->item_id;
            $data['workout_id'] = null;
        }

        // Cek apakah sudah ada submission untuk meal/workout ini hari ini oleh trainee_profiles.id ini
        $existingSubmission = ProgressSubmission::where('trainee_id', $loggedInTraineeProfileId) // <-- BERUBAH
            ->where(function ($query) use ($request) {
                if ($request->type === 'workout') {
                    $query->where('workout_id', $request->item_id);
                } else {
                    $query->where('meal_id', $request->item_id);
                }
            })
            ->whereDate('submitted_at', today())
            ->first();

        if ($existingSubmission) {
            return redirect()->back()->with('warning', 'You have already submitted today.');
        }

        ProgressSubmission::create($data);

        return redirect()->back()->with('success', 'Progress was successfully submitted!');
    }

    /**
     * Menghapus (membatalkan) progress submission.
     */
    public function destroy(ProgressSubmission $progressSubmission)
    {
        $user = Auth::user();
        if (!$user->traineeProfile) {
            return redirect()->back()->with('error', 'Profil trainee tidak ditemukan.');
        }
        $loggedInTraineeProfileId = $user->traineeProfile->id; // <-- BERUBAH

        if ($progressSubmission->trainee_id !== $loggedInTraineeProfileId) { // <-- BERUBAH
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk membatalkan submission ini.');
        }

        $progressSubmission->delete();

        return redirect()->back()->with('success', 'Progress was successfully canceled!');
    }
}