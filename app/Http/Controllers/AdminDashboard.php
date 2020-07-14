<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    public function index(Request $request)
    {
        return view('admin-home')->with([
            'logo' => 'svg/fixandfree.co_logo_horizontal.svg',
        ]);
    }
}
