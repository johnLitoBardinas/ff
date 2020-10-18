<?php

namespace App\Http\Controllers;

class Profile extends Controller
{
    /**
     * Show Profile Info.
     */
    public function index()
    {
        return view('profile');
    }
}
