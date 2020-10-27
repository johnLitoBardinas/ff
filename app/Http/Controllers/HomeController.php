<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application dashboard for management (Manager || Cashier).
     */
    public function index()
    {
        return view('home');
    }
}
