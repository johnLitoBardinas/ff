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

/**
 * This Controller will facilitate the Request of an Admin,
 * Contains the following ACTIONS:
 *
 * 1. CRU D(diactivate) Delete ? Need to clarify this shit - BRANCH
 * 1.1 Searching via Branch Name and Branch ID/Code
 * 2. USers for a specific Branch. CRU (D) Deactivate -> inactive database.
 */