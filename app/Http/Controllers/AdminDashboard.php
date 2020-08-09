<?php

namespace App\Http\Controllers;

class AdminDashboard extends Controller
{
    public function index()
    {
        return view('admin-home')->with([
            'logo' => 'svg/fixandfree.co_logo_horizontal.svg',
            'homeUrl' => 'admin'
        ]);
    }
}
