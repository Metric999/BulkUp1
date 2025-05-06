<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TraineeProfileController extends Controller
{
    public function index()
    {
        

        return view('trainee.profile'); // Mengembalikan view profil
    }
}
