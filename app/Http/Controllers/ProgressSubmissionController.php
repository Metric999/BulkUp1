<?php

namespace App\Http\Controllers;

use App\Models\ProgressSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProgressSubmissionController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'type' => 'required|in:workout,mealplan',
        'item_id' => 'required|integer'
    ]);

    // dd(Auth::user());
    $trainee = Auth::user()->traineeProfile;
    $data = [
        'trainee_id' => $trainee->id, // ✅ gunakan id dari trainee_profiles
        'submitted_at' => now(),
    ];

    if ($request->type === 'workout' ) {
        $data['workout_id'] = $request->item_id;
    } else {
        $data['meal_id'] = $request->item_id; // pastikan ini sesuai nama kolom di tabel
    }

    // ✅ Simpan ke DB
    ProgressSubmission::create($data);

    return redirect()->back()->with('success', 'Progress submitted!');
    }
}
