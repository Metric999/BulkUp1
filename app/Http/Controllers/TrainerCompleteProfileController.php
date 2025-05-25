<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo')->store('uploads/trainers', 'public');
        } else {
            $photoPath = $user->photo;
        }

        // Update user
        $user->update([
            'name'              => $validated['name'],
            'gender'            => $validated['gender'],
            'dob'               => $validated['dob'],
            'height'            => $validated['height'],
            'weight'            => $validated['weight'],
            'about'             => $validated['about'] ?? null,
            'photo'             => $photoPath,
            'profile_completed' => true,
        ]);

        // Refresh user session
        $user->refresh(); // ambil ulang data dari DB
        Auth::setUser($user); // set ulang ke auth agar middleware tahu

        return redirect()->route('trainer.home')->with('success', 'Trainer profile updated and completed!');
    }
}
