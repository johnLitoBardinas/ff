<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        return view('home')->with([
            'logo' => 'svg/fixandfree.salon_logo_horizontal.svg',
            'homeUrl' => 'home',
        ]);
    }

}
