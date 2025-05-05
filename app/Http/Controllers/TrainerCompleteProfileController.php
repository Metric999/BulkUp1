<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrainerCompleteProfileController extends Controller
{
    public function showProfileForm()
    {
        return view('completeprofile/trainerprofile'); // Pastikan file view ada di resources/views/trainerprofile.blade.php
    }

    public function saveProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'about' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload photo
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/trainers', 'public');
        } else {
            $photoPath = 'uploads/default.png';
        }

        // Update trainer profile
        $user = Auth::user();
        $user->update([
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'about' => $validated['about'],
            'photo' => $photoPath,
        ]);

        return redirect()->route('trainer.profile')->with('success', 'Trainer profile updated successfully!');
    }
}
