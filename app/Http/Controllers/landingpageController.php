<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Simpan ke database
class landingpageController extends Controller
{
    public function index()
    {
      
      return view('landingpage');
    }

    public function contact()
    {
        return view('contact');
    }
}
