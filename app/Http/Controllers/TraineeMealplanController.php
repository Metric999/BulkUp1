<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TraineeMealplanController extends Controller
{
    public function index(Request $request)
    {
        $submitted = $request->query('submitted') ? explode(',', $request->query('submitted')) : [];
        $toggle = $request->query('toggle');

        if ($toggle) {
            if (in_array($toggle, $submitted)) {
                $submitted = array_diff($submitted, [$toggle]);
            } else {
                $submitted[] = $toggle;
            }
            return redirect()->route('mealplan', ['submitted' => implode(',', $submitted)]);
        }

        $meals = [
            [
                'id' => 'breakfast',
                'time' => '08:00 - Breakfast',
                'meal' => 'Oatmeal and Banana',
                'calories' => '350 kcal',
                'note' => 'Start your day with energy',
                'color' => 'yellow',
            ],
            [
                'id' => 'lunch',
                'time' => '12:00 - Lunch',
                'meal' => 'Grilled Chicken and Rice',
                'calories' => '500 kcal',
                'note' => 'High protein for muscle recovery',
                'color' => 'blue',
            ],
            [
                'id' => 'dinner',
                'time' => '19:00 - Dinner',
                'meal' => 'Steamed Fish and Vegetables',
                'calories' => '400 kcal',
                'note' => 'Nutritious end to the day',
                'color' => 'pink',
            ],
            [
                'id' => 'snack',
                'time' => '21:00 - Snack',
                'meal' => 'Greek Yogurt and Almonds',
                'calories' => '200 kcal',
                'note' => 'Light snack before bedtime',
                'color' => 'green',
            ]
        ];

        return view('trainee.mealplan', compact('meals', 'submitted'));
    }
}
