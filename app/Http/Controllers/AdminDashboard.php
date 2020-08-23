<?php

namespace App\Http\Controllers;

class AdminDashboard extends Controller
{
    /**
     * Show Admin Home.
     */
    public function index()
    {
        return view('admin-home');
    }
}
