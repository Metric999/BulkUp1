<?php

// app/Http/Controllers/TrainerNotificationController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class TrainerNotificationController extends Controller
{
    public function index()
    {
    $notifications = Notification::orderBy('tanggal', 'desc')->get();
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
            'judul'   => $request->judul,
            'pesan'   => $request->pesan,
            'tanggal' => now(),
        ]);

        return redirect()->back()->with('success', 'Notifikasi berhasil ditambahkan!');
    }
}
