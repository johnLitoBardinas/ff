<?php

namespace App\Http\Controllers\Auth;

use App\Rules\IsActive;
use App\Enums\AccessHomeType;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\User;
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
    protected function validateLogin($request)
    {
        $request->validate([
            'email' => ['required', 'string:max:191', new IsActive()],
            'password' => 'required|string',
        ]);
    }

    /**
     * Custom redirection if the user is a Admin | Manager or Cashier
     */
    public function redirectTo()
    {
        $requestAccessPage = request('home_type');
        $authUser = Auth::user();
        $userRole = $authUser->role;

        if ( $requestAccessPage === AccessHomeType::FFCO && $userRole->name === UserType::ADMIN )  {
            $this->redirectTo = route('admin');
            $apiToken = $this->createAccessToken($authUser, 'user:admin');
            generate_session_data($apiToken, config('constant.fix_and_free_co_logo'), route('admin'));
            return $this->redirectTo;
        }

        $this->redirectTo = RouteServiceProvider::HOME;
        $apiToken = $this->createAccessToken($authUser, 'user:mgr');
        generate_session_data($apiToken, config('constant.fix_and_free_salon_logo'), route('home'));
        return $this->redirectTo;
    }

    /**
     * Generating API Token for the Client Application.
     */
    private function createAccessToken(User $user, String $ability)
    {
        $userToken = generate_user_token($user);
        return $user->createToken($userToken, [$ability])->plainTextToken;
    }

}
