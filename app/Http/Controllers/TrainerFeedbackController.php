<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerFeedbackController extends Controller
{
    public function index()
    {
        return view('trainer.feedback');
    }
}
