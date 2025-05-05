<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TrainerProgressController extends Controller
{
    public function index()
    {
        // Dummy data, ganti dengan data dari database jika sudah tersedia
        $trainees = [
            [
                'name' => 'Budi',
                'mealplan_done' => 12,
                'workout_done' => 9,
                'last_submit' => Carbon::now()->subDays(2)->diffForHumans(),
            ],
            [
                'name' => 'Sari',
                'mealplan_done' => 15,
                'workout_done' => 11,
                'last_submit' => Carbon::now()->subDay()->diffForHumans(),
            ],
            [
                'name' => 'Tono',
                'mealplan_done' => 8,
                'workout_done' => 6,
                'last_submit' => Carbon::now()->subDays(3)->diffForHumans(),
            ],
        ];

        return view('trainer.progress', compact('trainees'));
    }
}
