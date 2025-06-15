<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class TrainerFeedbackController extends Controller
{
    public function index()
    {
        $feedbackList = Feedback::with('trainee')
            ->whereHas('trainee.traineeProfile', function ($query) {
                $query->where('trainer_id', Auth::id());
            })
            ->orderBy('date', 'desc') // urut dari yang terbaru
            ->get();

        return view('trainer.feedback', compact('feedbackList'));
    }
}
