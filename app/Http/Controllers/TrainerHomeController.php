<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerHomeController extends Controller
{
    public function index()
    {
        // Simulasi data
        $trainerName = "Michael";
        $trainees = [
            ["id" => "1", "name" => "Andre"],
            ["id" => "2", "name" => "Marwan"],
            ["id" => "3", "name" => "Raymond"],
        ];

        $totalTrainees = count($trainees);
        $totalWorkoutPlans = 12;  // Bisa diganti dengan perhitungan dinamis
        $totalMealPlans = 9;      // Sama seperti di atas

        return view('trainer.home', compact('trainerName', 'trainees', 'totalTrainees', 'totalWorkoutPlans', 'totalMealPlans'));
    }
}
