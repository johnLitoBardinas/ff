<?php

namespace App\Http\Controllers;

class AdminDashboard extends Controller
{
    public function index()
    {
        return view('admin-home');
    }
}
