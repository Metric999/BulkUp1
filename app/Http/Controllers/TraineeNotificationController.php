<?php

namespace App\Http\Controllers;

use App\Models\Notification as UserNotification; // Model kamu
use Illuminate\Http\Request;

class TraineeNotificationController extends Controller
{
    public function index()
    {
        // Panggil model pakai alias UserNotification
        $notifications = UserNotification::orderBy('tanggal', 'desc')->get();

        return view('trainee.notification', compact('notifications'));
    }
}
