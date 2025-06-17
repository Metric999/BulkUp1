<?php

namespace App\Http\Controllers;
// Simpan ke database
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class TraineeFeedbackController extends Controller
{// Simpan ke database
    public function submit(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'trainee_id' => Auth::id(),
            'comment' => $request->input('feedback'),
            'date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
    public function index()
{
    return view('trainee.feedback'); // pastikan view ini ada di /resources/views/trainee/feedback.blade.php
}
}
