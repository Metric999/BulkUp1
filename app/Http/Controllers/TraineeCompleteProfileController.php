<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TraineeProfile;
use App\Models\User;

class TraineeCompleteProfileController extends Controller
{
    public function show() 
    {
        $user = Auth::user();
        $profile = $user->profile;

        // Ambil list trainer untuk select option
        $trainers = User::where('role', 'trainer')->get();

        return view('completeprofile.traineeprofile', compact('profile', 'trainers'));
    }

   public function update(Request $request)
    {
    $user = Auth::user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'gender' => 'required|in:Male,Female',
        'age' => 'required|integer|min:10',
        'height' => 'required|integer|min:50',
        'weight' => 'required|integer|min:20',
        'trainer_id' => 'required|exists:users,id',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename, 'public');
        $validated['photo'] = $path;
    }

    $validated['user_id'] = $user->id;

    TraineeProfile::updateOrCreate(
        ['user_id' => $user->id],
        $validated
    );

    // ✅ Tandai profile sudah lengkap & simpan trainer_id ke users
    $user->profile_completed = true;
    $user->trainer_id = $request->input('trainer_id');
    $user->save();

    return redirect('/trainee/home')->with('success', 'Profile updated successfully');
    }
}
