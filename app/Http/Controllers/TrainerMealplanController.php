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
        $trainees = User::with('mealPlans')
            ->whereHas('traineeProfile', function ($q) {
                $q->where('trainer_id', Auth::id());
            })
            ->get();
    
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
            'trainer_id' => Auth::id(),
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

    public function update(Request $request, MealPlan $meal)
    {
        // Pastikan meal plan milik trainer yang login
        if ($meal->trainer_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'time' => 'required',
            'type' => 'required|string|max:50',
            'meal_name' => 'required|string|max:255',
            'calories' => 'required|numeric',
            'note' => 'nullable|string',
        ]);

        $meal->update([
            'time' => $request->time,
            'type' => $request->type,
            'meal_name' => $request->meal_name,
            'calories' => $request->calories,
            'note' => $request->note,
        ]);

        return redirect()->back()->with('success', 'Meal plan updated successfully.');
    }

    public function destroy(MealPlan $meal)
    {
        // Pastikan meal plan milik trainer yang login
        if ($meal->trainer_id !== Auth::id()) {
            abort(403);
        }

        $meal->delete();

        return redirect()->back()->with('success', 'Meal plan deleted successfully.');
    }
}
