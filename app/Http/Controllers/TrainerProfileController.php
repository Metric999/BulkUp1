<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrainerProfileController extends Controller
{
    // Tampilkan form lengkapin profile
    public function showCompleteProfileForm()
    {
        $user = Auth::user();

        return view('completeprofile.trainerprofile', [
            'user' => $user
        ]);
    }

    // Simpan data profile lengkap
    public function saveCompleteProfile(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'dob'    => 'required|integer|min:1|max:120',
            'height' => 'required|numeric|min:30|max:300',
            'weight' => 'required|numeric|min:10|max:500',
            'about'  => 'nullable|string|max:1000',
            'photo'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Upload photo jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama kalau bukan default
            if ($user->photo && $user->photo !== 'uploads/default.png') {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo')->store('uploads/trainers', 'public');
        } else {
            $photoPath = $user->photo ?? 'uploads/default.png';
        }

        // Update user profile
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

        return redirect()->route('trainer.profile.show')->with('success', 'Profile successfully updated!');
    }

    // Tampilkan halaman profil trainer (read only)
    public function showProfile()
    {
        $user = Auth::user();

        return view('trainer.profile', [
            'trainerName' => $user->name,
            'gender'      => $user->gender,
            'dob'         => $user->dob,
            'height'      => $user->height,
            'weight'      => $user->weight,
            'email'       => $user->email,
            'about'       => $user->about,
            'photo'       => $user->photo,
        ]);
    }
}
