<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function home()
    {
        return view('home');
    }
    public function dashboard()
    {
        return view('dashboard');
    }
}
