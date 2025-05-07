<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerProfileController extends Controller
{
    public function show()
    {
        // Dummy data untuk ditampilkan di view
        $data = [
            'trainerName' => 'Michael',
            'email' => 'michael@gmail.com',
            'phone' => '+62 812 3456 7890',
            'specialty' => 'Muscle Gain & Nutrition',
            'bio' => 'Certified personal trainer with 10+ years of experience helping clients achieve their fitness goals.'
        ];

        return view('trainer.profile', $data);
    }

    public function edit()
    {
        // Untuk halaman edit profile (opsional jika belum dibuat)
        return view('trainer.edit-profile');
    }
}
