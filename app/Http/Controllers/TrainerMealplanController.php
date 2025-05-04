<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerMealplanController extends Controller
{
    public function index()
    {
        // Menampilkan halaman meal plan
        return view('trainer.mealplan');
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'trainee_id' => 'required|integer',
            'meal_date' => 'required|date',
            'time' => 'required',
            'type' => 'required|string|max:255',
            'meal' => 'required|string|max:255',
            'calories' => 'required|integer',
            'note' => 'nullable|string|max:255',
        ]);

        // Menyimpan meal plan ke database (contoh menggunakan model MealPlan)
        // MealPlan::create([
        //     'trainee_id' => $request->trainee_id,
        //     'meal_date' => $request->meal_date,
        //     'time' => $request->time,
        //     'type' => $request->type,
        //     'meal' => $request->meal,
        //     'calories' => $request->calories,
        //     'note' => $request->note,
        // ]);

        // Redirect atau beri feedback
        return redirect()->route('trainer.mealplan')->with('success', 'Meal Plan has been saved successfully!');
    }
}
