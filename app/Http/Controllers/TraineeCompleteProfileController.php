<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TraineeCompleteProfileController extends Controller
{
    public function showProfileForm()
    {
        return view('completeprofile/traineeprofile'); // File HTML kamu simpan sebagai traineeprofile.blade.php
    }

    public function saveProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'dob' => 'required|integer|min:0',
            'height' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'goals' => 'nullable|string|max:255',
            'trainer' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // foto optional
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/trainee', 'public');
        } else {
            $photoPath = 'uploads/default.png'; // default photo
        }

        // Save profile data (Contoh: update ke user login)
        $user = Auth::user();
        $user->update([
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'goals' => $validated['goals'],
            'trainer' => $validated['trainer'],
            'photo' => $photoPath,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}

