<?php

namespace App\Http\Controllers;

class Profile extends Controller
{
    /**
     * Show Profile Information.
     */
    public function index()
    {
        return view('profile');
    }
}
