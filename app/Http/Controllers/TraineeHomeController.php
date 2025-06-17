<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;

class TraineeHomeController extends Controller
{
    public function showHome()
    {
        return view('trainee/home', [
            'weight' => '',
            'height' => '',
            'age' => '',
            'gender' => '',
            'bmiResult' => null,
            'bmiCategory' => null,
            'activeTab' => 'progressTab'
        ]);
    }

    public function calculateBMI(Request $request)
{
    $weight = $request->input('weight');
    $height = $request->input('height');
    $age = $request->input('age');
    $gender = $request->input('gender');

    $bmiResult = null;
    $bmiCategory = null;

    if ($weight && $height) {
        $bmiResult = $this->calculateBMIValue($weight, $height);
        $bmiCategory = $this->getBMICategory($bmiResult);

        // Simpan ke database
        $traineeId = Auth::user()->traineeProfile->id;

        WeightLog::create([
            'trainee_id' => $traineeId,
            'weight' => $weight,
            'height' => $height,
            'age' => $age,
            'gender' => $gender,
            'bmi_result' => $bmiResult,
            'bmi_category' => $bmiCategory,
        ]);
    }

    return view('trainee.home', [
        'weight' => $weight,
        'height' => $height,
        'age' => $age,
        'gender' => $gender,
        'bmiResult' => $bmiResult,
        'bmiCategory' => $bmiCategory,
        'activeTab' => 'bmiTab'
    ]);
}


    private function calculateBMIValue($weight, $height)
    {
        $heightInMeters = $height / 100;
        $bmi = $weight / ($heightInMeters * $heightInMeters);
        return number_format($bmi, 1);
    }

    private function getBMICategory($bmi)
    {
        if ($bmi < 18.5) return 'Kurus';
        elseif ($bmi < 25) return 'Normal';
        elseif ($bmi < 30) return 'Gemuk';
        else return 'Obesitas';
    }
}
