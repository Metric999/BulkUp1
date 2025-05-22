<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class TraineeCompleteProfileController extends Controller
{
    public function show() 
{
    $user = Auth::user();
    $profile = $user->profile;

    return view('completeprofile.traineeprofile', compact('profile'));
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
            'goals' => 'nullable|string|max:255',
            'trainer' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');
            $validated['photo'] = $path;
        }

        // Update or create profile ok
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            array_merge($validated, ['user_id' => $user->id])
        );

        return redirect()->route('profile.complete')->with('success', 'Profile updated successfully');
    }
}

