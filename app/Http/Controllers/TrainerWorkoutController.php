<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Simpan ke database
class TrainerWorkoutController extends Controller
{
    public function index(Request $request)
    {
        $trainees = User::whereHas('traineeProfile', function ($q) {
            $q->where('trainer_id', Auth::id());
        })->get();

        $selectedTrainee = null;
        $workouts = [];

        if ($request->trainee_id) {
            $selectedTrainee = User::find($request->trainee_id);
            if ($selectedTrainee) {
                $workouts = Workout::where('trainee_id', $selectedTrainee->id)
                    ->orderByDesc('date')
                    ->get();
            }
        }

        return view('trainer.workout', compact('trainees', 'selectedTrainee', 'workouts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trainee_id' => 'required|exists:users,id',
            'workout_date' => 'required|date',
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'difficulty' => 'required|string|max:50',
            'reps' => 'required|string|max:50',
            'video_url' => 'nullable|url',
        ]);

        $day = \Carbon\Carbon::parse($request->workout_date)->format('l');

        Workout::create([
            'trainer_id' => Auth::id(),
            'trainee_id' => $request->trainee_id,
            'day' => $day,
            'date' => $request->workout_date,
            'name' => $request->name,
            'kategori' => $request->category,
            'difficult' => $request->difficulty,
            'reps' => $request->reps,
            'videoUrl' => $request->video_url,
        ]);

        return redirect()->back()->with('success', 'Workout added successfully.');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'category' => 'required|string',
        'difficulty' => 'required|string',
        'reps' => 'required|string',
        'video_url' => 'nullable|url',
    ]);

    $workout = Workout::findOrFail($id);
    $workout->update([
        'name' => $request->name,
        'kategori' => $request->category,
        'difficult' => $request->difficulty,
        'reps' => $request->reps,
        'videoUrl' => $request->video_url,
    ]);

    return back()->with('success', 'Workout updated successfully.');
}

public function destroy($id)
{
    $workout = Workout::findOrFail($id);
    $workout->delete();

    return back()->with('success', 'Workout deleted successfully.');
}
}
