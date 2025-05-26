<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TrainerProfileController extends Controller
{
    // Tampilkan halaman profile trainer (read-only)
    public function show()
    {
        $user = Auth::user();

        $age = $user->dob ? Carbon::parse($user->dob)->age : null;

        return view('trainer.profile', [
            'trainerName' => $user->name,
            'gender'      => $user->gender,
            'dob'         => $age,
            'height'      => $user->height,
            'weight'      => $user->weight,
            'email'       => $user->email,
            'about'       => $user->about,
            'photo'       => $user->photo,
        ]);
    }

    // Tampilkan form lengkapin profile (edit/complete)
    public function showCompleteProfileForm()
    {
        $user = Auth::user();

        return view('completeprofile.trainerprofile', [
            'user' => $user
        ]);
    }

    // Simpan data profile lengkap trainer
    public function saveCompleteProfile(Request $request)
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

        if ($request->hasFile('photo')) {
            if ($user->photo && $user->photo !== 'uploads/default.png') {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo')->store('uploads/trainers', 'public');
        } else {
            $photoPath = $user->photo ?? 'uploads/default.png';
        }

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

        return redirect()->route('trainer.profile')->with('success', 'Profile successfully updated!');
    }
}
