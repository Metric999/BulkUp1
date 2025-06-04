<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class TraineeNotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::orderBy('tanggal', 'desc')->get();
        return view('trainee.notification', compact('notifications'));
    }
}
