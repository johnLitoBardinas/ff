<?php

namespace App\Http\Controllers\Auth;

use App\Enums\AccessHomeType;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Custom redirection if the user is a Admin | Manager or Cashier
     */
    public function redirectTo()
    {
        $request_access_page = request('home_type');
        $auth_user = Auth::user();

        if ( ! $auth_user->isActive() ) {
            Auth::logout();
            return abort(401);
        }

        if ( $request_access_page === AccessHomeType::FFCO && $auth_user->isAdmin() )  {
            $this->redirectTo = route('admin');
            return $this->redirectTo;
        }

        $this->redirectTo = RouteServiceProvider::HOME;
        return $this->redirectTo;
    }

}
