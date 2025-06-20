<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\User;
use App\Models\TraineeProfile; // Import TraineeProfile
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerMealPlanController extends Controller
{
    public function index()
    {
        // Ambil User yang merupakan trainee dari trainer yang sedang login,
        // lalu eager load TraineeProfile mereka dan MealPlans yang terkait dengan profil itu.
        $trainees = User::whereHas('traineeProfile', function ($q) {
                $q->where('trainer_id', Auth::id());
            })
            // Eager load traineeProfile dan mealplans melalui traineeProfile
            ->with(['traineeProfile.mealplans']) // <-- BERUBAH
            ->get();

        return view('trainer.mealplan', compact('trainees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trainee_id' => 'required|exists:users,id', // Tetap User ID dari dropdown
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required|string|max:50',
            'meal_name' => 'required|string|max:255',
            'calories' => 'required|numeric',
            'note' => 'nullable|string',
        ]);

        // Cari TraineeProfile ID dari User ID yang dipilih di form
        $traineeProfile = TraineeProfile::where('user_id', $request->trainee_id)->first();

        if (!$traineeProfile) {
            return redirect()->back()->with('error', 'Trainee profile not found for the selected user.');
        }

        MealPlan::create([
            'trainer_id' => Auth::id(), // Trainer ID tetap User ID
            'trainee_id' => $traineeProfile->id, // <-- BERUBAH: Gunakan trainee_profiles.id
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