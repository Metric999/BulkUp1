<?php

namespace App\Http\Controllers;

use App\Models\Feedback;

class TrainerFeedbackController extends Controller
{
    public function index()
    {
        $feedbackList = Feedback::with('trainee')->orderBy('date', 'desc')->get();
        return view('trainer.feedback', compact('feedbackList'));
    }
}
