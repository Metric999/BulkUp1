<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\TrainerProfile;

class TrainerCompleteProfileController extends Controller
{
    public function showProfileForm()
    {
        return view('completeprofile.trainerprofile');
    }

    public function saveProfile(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'dob'    => 'required|date',
            'height' => 'required|numeric|min:30|max:300',
            'weight' => 'required|numeric|min:10|max:500',
            'about'  => 'nullable|string|max:1000',
            'photo'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/trainers', 'public');
        }

        // Simpan ke tabel trainer_profiles
        TrainerProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name'   => $validated['name'],
                'gender' => $validated['gender'],
                'dob'    => $validated['dob'],
                'height' => $validated['height'],
                'weight' => $validated['weight'],
                'about'  => $validated['about'] ?? null,
                'photo'  => $photoPath,
            ]
        );

        // Tandai profil user sudah lengkap
        $user->update(['profile_completed' => true]);

        return redirect()->route('trainer.home')->with('success', 'Trainer profile saved!');
    }
}
