<?php

namespace App\Http\Controllers;

use App\Models\ProgressSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProgressSubmissionController extends Controller
{
    public function store(Request $request)
    {// Simpan ke database
        $request->validate([
            'type' => 'required|in:workout,mealplan',
            'item_id' => 'required|integer'
        ]);

        $trainee = Auth::user()->traineeProfile;

        $data = [
            'trainee_id' => $trainee->id,
            'submitted_at' => now(),
        ];

        if ($request->type === 'workout') {
            $data['workout_id'] = $request->item_id;
        } else {
            $data['meal_plan_id'] = $request->item_id;
        }

        ProgressSubmission::create($data);

        return redirect()->back()->with('success', 'Progress submitted!');
    }
}

