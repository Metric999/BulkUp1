<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TraineeFeedbackController extends Controller
{
    // Menampilkan form feedback
    public function showForm()
    {
        return view('trainee.feedback_form');
    }

    // Menangani submit feedback
    public function submitForm(Request $request)
    {
        $feedback = trim($request->input('feedback'));

        if (!empty($feedback)) {
            // Simpan ke file di storage/app/feedbacks.txt
            Storage::append('feedbacks.txt', $feedback);

            // Redirect balik dengan pesan sukses
            return redirect()->route('trainee.feedback')->with('success', 'Thank you for your feedback!');
        } else {
            // Redirect balik dengan error
            return redirect()->route('trainee.feedback')->with('error', 'Please write something before submitting.');
        }
    }
}
