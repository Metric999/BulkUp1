<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TraineeProfileController extends Controller
{
    /**
     * Tampilkan halaman profil trainee
     */
    public function index()
    {
        $user = Auth::user();
        $profile = $user->traineeprofile()->with('trainer')->first();

        return view('trainee.profile', compact('user', 'profile'));
    }

    /**
     * Update data profil trainee
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'gender' => 'nullable|string',
            'age'    => 'nullable|integer',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'photo'  => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $profile = $user->traineeprofile;

        // Update nama di tabel trainee_profiles (bukan users)
        $profile->name = $request->name;

        // Update foto jika diunggah
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }

            $photoPath = $request->file('photo')->store('profile_photos', 'public');
            $profile->photo = $photoPath;
        }

        // Update field profil lainnya
        $profile->gender = $request->gender;
        $profile->age = $request->age;
        $profile->height = $request->height;
        $profile->weight = $request->weight;
        $profile->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
// File: Testing/app/Http/Controllers/TraineeProfileController.php