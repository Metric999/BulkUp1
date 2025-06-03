<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TrainerProfileController extends Controller
{
    // Tampilkan halaman profile trainer
    public function show()
    {
        $user = Auth::user();
        $profile = $user->trainerProfile;

        $age = $profile && $profile->dob ? Carbon::parse($profile->dob)->age : null;

        return view('trainer.profile', [
            'trainerName' => $profile->name ?? $user->name,
            'gender'      => $profile->gender ?? '-',
            'dob'         => $age ?? '-',
            'height'      => $profile->height ?? '-',
            'weight'      => $profile->weight ?? '-',
            'email'       => $user->email, // Tidak bisa diubah
            'about'       => $profile->about ?? '-',
            'photo'       => $profile->photo ?? 'uploads/default.png',
        ]);
    }

    // Form untuk melengkapi profil trainer
    public function showCompleteProfileForm()
    {
        $user = Auth::user();
        $profile = $user->trainerProfile;

        return view('completeprofile.trainerprofile', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    // Simpan data profil trainer
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
        $profile = $user->trainerProfile ?? $user->trainerProfile()->create([]);

        // Simpan foto
        if ($request->hasFile('photo')) {
            if ($profile->photo && $profile->photo !== 'uploads/default.png') {
                Storage::disk('public')->delete($profile->photo);
            }
            $photoPath = $request->file('photo')->store('uploads/trainers', 'public');
        } else {
            $photoPath = $profile->photo ?? 'uploads/default.png';
        }

        // Simpan data ke trainer_profiles (bukan ke tabel users)
        $profile->update([
            'name'   => $validated['name'],
            'gender' => $validated['gender'],
            'dob'    => $validated['dob'],
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'about'  => $validated['about'] ?? null,
            'photo'  => $photoPath,
        ]);

        return redirect()->route('trainer.profile')->with('success', 'Profile successfully updated!');
    }
}
