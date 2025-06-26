<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TrainerProfile;

class TrainerCompleteProfileController extends Controller
{
    /**
     * Menampilkan form isi profile trainer
     */
    public function showProfileForm()
    {
        // Ambil data profil jika sudah pernah diisi
        $trainerProfile = TrainerProfile::where('user_id', Auth::id())->first();

        return view('completeprofile.trainerprofile', compact('trainerProfile'));
    }

    /**
     * Menyimpan data profile trainer
     */
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

        // Ambil profil lama (jika ada)
        $existingProfile = TrainerProfile::where('user_id', $user->id)->first();
        $photoPath = $existingProfile->photo ?? null;

        // Simpan foto jika di-upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/trainers', 'public');
        }

        // Simpan atau update data ke database
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

        // Update flag profil lengkap
        $user->update(['profile_completed' => true]);

        return redirect()->route('trainer.home')->with('success', 'Trainer profile saved!');
    }
}
