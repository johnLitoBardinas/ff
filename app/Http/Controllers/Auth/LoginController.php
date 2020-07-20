<?php

namespace App\Http\Controllers\Auth;

use App\Rules\IsActive;
use App\Enums\AccessHomeType;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * @var string
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
    protected function validateLogin($request)
    {
        $request->validate([
            'email' => ['required', 'string:max:255', new IsActive()],
            'password' => 'required|string',
        ]);
    }

    /**
     * Custom redirection if the user is a Admin | Manager or Cashier
     */
    public function redirectTo()
    {
        $requestAccessPage = request('home_type');
        // dd( Auth::user() );
        // dd(compact( 'requestAccessPage', 'authUser' ));

        // if ( $requestAccessPage === AccessHomeType::FFCO && $authUser->user_type === UserType::ADMIN )  {
        //     $this->redirectTo = route('admin');
        //     return $this->redirectTo;
        // }

        $this->redirectTo = RouteServiceProvider::HOME;
        return $this->redirectTo;
    }

}
