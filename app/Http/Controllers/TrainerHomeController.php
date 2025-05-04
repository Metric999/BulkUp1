<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerHomeController extends Controller
{
    public function index()
    {
        // Simulasi data (nanti bisa diganti dengan data dari database)
        $trainerName = "Coach";
        $trainees = [
            ["id" => "1", "name" => "Andre"],
            ["id" => "2", "name" => "Marwan"],
            ["id" => "3", "name" => "Raymond"],
        ];

        $totalTrainees = count($trainees);
        $totalWorkoutPlans = 12; // Dummy data
        $totalMealPlans = 9;

        return view('trainer.home', compact(
            'trainerName',
            'trainees',
            'totalTrainees',
            'totalWorkoutPlans',
            'totalMealPlans'
        ));
    }
}
