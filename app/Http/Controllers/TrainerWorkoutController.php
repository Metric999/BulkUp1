<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\User;
use App\Models\ProgressSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerWorkoutController extends Controller
{
    /**
     * Menampilkan daftar workout berdasarkan trainee yang dipilih,
     * serta menyembunyikan workout yang sudah disubmit trainee.
     */
    public function index(Request $request)
    {
        $trainees = User::whereHas('traineeProfile', function ($q) {
            $q->where('trainer_id', Auth::id());
        })->get();

        $selectedTraineeId = $request->input('trainee_id');
        $selectedTrainee = null;
        $workouts = [];

        // Jika hanya satu trainee, pilih otomatis
        if (!$selectedTraineeId && $trainees->count() === 1) {
            $selectedTraineeId = $trainees->first()->id;
        }

        if ($selectedTraineeId) {
            $selectedTrainee = $trainees->where('id', $selectedTraineeId)->first();

            if ($selectedTrainee && $selectedTrainee->traineeProfile) {
                $traineeProfileId = $selectedTrainee->traineeProfile->id;

                // Ambil workout ID yang sudah disubmit oleh trainee
                $submittedWorkoutIds = ProgressSubmission::where('trainee_id', $traineeProfileId)
                    ->whereNotNull('workout_id')
                    ->pluck('workout_id')
                    ->toArray();

                // Tampilkan workout yang belum disubmit
                $workouts = Workout::where('trainee_id', $selectedTrainee->id)
                    ->whereNotIn('id', $submittedWorkoutIds)
                    ->orderByDesc('date')
                    ->get();
            }
        }

        return view('trainer.workout', compact('trainees', 'selectedTrainee', 'workouts'));
    }

    /**
     * Menyimpan workout baru untuk trainee.
     */
    public function store(Request $request)
    {
        $request->validate([
            'trainee_id'   => 'required|exists:users,id',
            'workout_date' => 'required|date',
            'name'         => 'required|string|max:100',
            'category'     => 'required|string|max:100',
            'difficulty'   => 'required|string|max:50',
            'reps'         => 'required|string|max:50',
            'video_url'    => 'nullable|url',
        ]);

        $day = \Carbon\Carbon::parse($request->workout_date)->format('l');

        Workout::create([
            'trainer_id' => Auth::id(),
            'trainee_id' => $request->trainee_id,
            'day'        => $day,
            'date'       => $request->workout_date,
            'name'       => $request->name,
            'kategori'   => $request->category,
            'difficult'  => $request->difficulty,
            'reps'       => $request->reps,
            'videoUrl'   => $request->video_url,
        ]);

        return redirect()->back()->with('success', 'Workout added successfully.');
    }

    /**
     * Memperbarui data workout yang ada.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'category'   => 'required|string|max:100',
            'difficulty' => 'required|string|max:50',
            'reps'       => 'required|string|max:50',
            'video_url'  => 'nullable|url',
        ]);

        $workout = Workout::findOrFail($id);

        // Opsional: pastikan hanya trainer pemilik yang bisa update
        if ($workout->trainer_id !== Auth::id()) {
            abort(403);
        }

        $workout->update([
            'name'      => $request->name,
            'kategori'  => $request->category,
            'difficult' => $request->difficulty,
            'reps'      => $request->reps,
            'videoUrl'  => $request->video_url,
        ]);

        return back()->with('success', 'Workout updated successfully.');
    }

    /**
     * Menghapus workout.
     */
    public function destroy($id)
    {
        $workout = Workout::findOrFail($id);

        if ($workout->trainer_id !== Auth::id()) {
            abort(403);
        }

        $workout->delete();

        return back()->with('success', 'Workout deleted successfully.');
    }
}
