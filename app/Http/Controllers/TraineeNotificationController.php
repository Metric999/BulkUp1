<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TraineeNotificationController extends Controller
{
    public function index()
    {
        // Simulated notification history
        $notification_history = [
            [
                "datetime" => "2025-04-21 23:32",
                "title" => "🍽️ Breakfast Time!",
                "message" => "Don’t forget to eat some protein to start your day."
            ],
            [
                "datetime" => "2025-04-21 23:23",
                "title" => "🍗 Lunch Time!",
                "message" => "Rice + chicken + veggies for energy!"
            ],
            [
                "datetime" => "2025-04-22 03:23",
                "title" => "😴 Time to Sleep!",
                "message" => "Recovery is important, bro!"
            ],
            [
                "datetime" => "2025-04-22 08:00",
                "title" => "🧘 Let's Do Some Stretching!",
                "message" => "Keep your body from getting stiff all day."
            ]
        ];

        return view('trainee.notification_history', compact('notification_history'));
    }
}
