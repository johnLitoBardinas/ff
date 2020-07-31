<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function __construct()
    {
        $this->middleware('guest');
    }

    public function showLoginForm()
    {
        return view('sanctum.login');
    }


}
