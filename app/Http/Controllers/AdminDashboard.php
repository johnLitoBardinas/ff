<?php

namespace App\Http\Controllers;

class AdminDashboard extends Controller
{
    /**
     * Show Admin Home (Admin || Super Admin).
     */
    public function index()
    {
        return view('admin-home');
    }
}
