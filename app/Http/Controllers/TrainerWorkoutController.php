<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TrainerWorkoutController extends Controller
{
    private $trainees = [
        ["id" => "1", "name" => "Andre"],
        ["id" => "2", "name" => "Marwan"],
        ["id" => "3", "name" => "Raymond"],
    ];

    private $daysOfWeek = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];

    public function index(Request $request)
    {
        $selectedTrainee = $request->session()->get('selected_trainee', $this->trainees[0]['id']);
        $workouts = Session::get("workouts.$selectedTrainee", []);

        $traineeName = collect($this->trainees)->firstWhere('id', $selectedTrainee)['name'] ?? 'unknown';

        return view('trainer.workout', [
            'trainees' => $this->trainees,
            'selectedTrainee' => $selectedTrainee,
            'traineeName' => $traineeName,
            'workouts' => $workouts,
            'daysOfWeek' => $this->daysOfWeek,
        ]);
    }

    public function handleForm(Request $request)
    {
        $traineeId = $request->input('trainee_id');
        Session::put('selected_trainee', $traineeId);

        $action = $request->input('action');
        $day = $request->input('day');
        $index = $request->input('index');
        $workouts = Session::get("workouts.$traineeId", []);

        if ($action === 'add') {
            $workouts[$day][] = $request->only(['name', 'kategori', 'difficult', 'reps', 'videoUrl']);
        } elseif ($action === 'edit' && $index !== null) {
            $workouts[$day][$index] = $request->only(['name', 'kategori', 'difficult', 'reps', 'videoUrl']);
        } elseif ($action === 'delete' && $index !== null) {
            unset($workouts[$day][$index]);
            $workouts[$day] = array_values($workouts[$day]);
        }

        Session::put("workouts.$traineeId", $workouts);
        return redirect()->route('trainee.workout');
    }
}
