<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
