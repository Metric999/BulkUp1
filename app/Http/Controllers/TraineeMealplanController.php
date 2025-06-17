<?php

namespace App\Http\Controllers;
// Simpan ke database
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MealPlan;
use App\Models\User;

class TraineeMealplanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $submitted = $request->query('submitted') ? explode(',', $request->query('submitted')) : [];
        $toggle = $request->query('toggle');

        // Toggle meal submitted
        if ($toggle) {
            if (in_array($toggle, $submitted)) {
                $submitted = array_diff($submitted, [$toggle]);
            } else {
                $submitted[] = $toggle;
            }
            return redirect()->route('trainee.mealplan', ['submitted' => implode(',', $submitted)]);
        }

        // Ambil ID trainer dari user login (dari field `trainer_id`)
        $trainerId = $user->trainer_id;

        // Ambil meal plan untuk trainee login dari trainer yang dipilih, dan untuk hari ini
        $meals = MealPlan::where('trainee_id', $user->id)
            ->where('trainer_id', $trainerId)
            ->whereDate('date', today())
            ->orderBy('time')
            ->get();

        return view('trainee.mealplan', compact('meals', 'submitted'));
    }
}
