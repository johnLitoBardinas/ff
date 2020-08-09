<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile extends Controller
{
    public function index(Request $request)
    {
        return view('profile')->with([
            'logo' => get_logo()
        ]);
    }
}
