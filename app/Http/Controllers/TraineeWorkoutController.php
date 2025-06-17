<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Workout;
use App\Models\ProgressSubmission;
// Simpan ke database
class TraineeWorkoutController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $trainee = $user->traineeProfile;

        if (!$trainee) {
            abort(403, 'No trainee profile found.');
        }

        // Workout yang sudah disubmit
        $submitted = ProgressSubmission::where('trainee_id', $trainee->user_id)
            ->whereNotNull('workout_id')
            ->pluck('workout_id')
            ->toArray();

        // Toggle submit/unsubmit
        if ($request->has('toggle')) {
            $workoutId = $request->toggle;

            if (in_array($workoutId, $submitted)) {
                ProgressSubmission::where('trainee_id', $trainee->user_id)
                    ->where('workout_id', $workoutId)
                    ->delete();
                $submitted = array_diff($submitted, [$workoutId]);
            } else {
                ProgressSubmission::create([
                    'trainee_id' => $trainee->user_id,
                    'workout_id' => $workoutId,
                    'submitted_at' => now(),
                ]);
                $submitted[] = $workoutId;
            }

            return redirect()->route('trainee.workout', ['submitted' => implode(',', $submitted)]);
        }

        // Ambil workout yang dibuat trainer untuk trainee ini
        $workouts = Workout::where('trainee_id', $trainee->user_id)
            ->whereDate('date', today())  // untuk meenampilkan workout hari ini
            ->orderBy('day')
            ->get()
            ->groupBy('day');

        return view('trainee.workout', [
            'traineeName' => $trainee->name,
            'workouts' => $workouts,
            'submitted' => $submitted,
        ]);
    }
}
