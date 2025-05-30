<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerMealPlanController extends Controller
{
    public function index()
    {
        // Ambil trainee yang memilih trainer ini
        $trainees = User::whereHas('traineeProfile', function ($q) {
            $q->where('trainer_id', Auth::id());
        })->get();

        return view('trainer.mealplan', compact('trainees'));
    }

    public function store(Request $request)
{
    $request->validate([
        'trainee_id' => 'required|exists:users,id',
        'date' => 'required|date',
        'time' => 'required',
        'type' => 'required|string|max:50',
        'meal_name' => 'required|string|max:255',
        'calories' => 'required|numeric',
        'note' => 'nullable|string',
    ]);

    MealPlan::create([
        'trainer_id' => Auth::id(), // ✅ tambahkan ini!
        'trainee_id' => $request->trainee_id,
        'date' => $request->date,
        'time' => $request->time,
        'type' => $request->type,
        'meal_name' => $request->meal_name,
        'calories' => $request->calories,
        'note' => $request->note,
    ]);

    return redirect()->back()->with('success', 'Meal plan saved successfully.');
    }
}

