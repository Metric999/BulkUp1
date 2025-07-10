<?php

// app/Http/Controllers/TrainerNotificationController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

// Simpan ke database
class TrainerNotificationController extends Controller
{
    public function index()
{
    $notifications = Notification::with('trainee')
        ->whereHas('trainee.traineeProfile', function ($query) {
            $query->where('trainer_id', Auth::id());
        })
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('trainer.notification', compact('notifications'));
}
    public function create()
    {
        return view('trainer.notification.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        Notification::create([
            'judul' => $request->judul,
            'pesan' => $request->pesan,
            'tanggal' => now(),
            'trainee_id' => $request->trainee_id, // ✅ Gunakan dari form
        ]);
        

        return redirect()->back()->with('success', 'Reminder successfully added!');
    }
}
