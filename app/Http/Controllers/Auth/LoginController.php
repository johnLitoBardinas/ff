<?php

namespace App\Http\Controllers\Auth;

use App\Rules\IsActive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Rules\IsUserBranchDeactivated;
use App\Rules\IsUserCanAccessBranch;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Validate the user login request.
     */
    protected function validateLogin( Request $request )
    {
        $request->validate([
            'email' => [
                'bail',
                'required',
                'string:max:191',
                new IsActive(),
                new IsUserBranchDeactivated(),
                new IsUserCanAccessBranch($request->input('home_type'))
            ],
            'password' => [
                'required',
                'string'
            ],
        ]);
    }

    /**
     * Custom redirection if the user is a Admin | Manager or Cashier
     */
    public function redirectTo()
    {
        $requestAccessPage = request('home_type');
        $authUser = Auth::user();

        return login_user_redirection($requestAccessPage, $authUser);
    }

}
