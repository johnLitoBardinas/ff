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
use Illuminate\Support\Facades\Hash;

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
            session(['apiToken' => $apiToken]);
            return $this->redirectTo;
        }

        $this->redirectTo = RouteServiceProvider::HOME;
        // $this->createAccessToken($authUser, 'user:mgr');
        return $this->redirectTo;
    }

    /**
     * Generating API Token for the Client Application.
     *
     * @param User $user Valid User
     * @param String $ability The ability for the user.
     *
     * @return String Valid API Token.
     */
    protected function createAccessToken(User $user, String $ability)
    {
        $userToken = generate_user_token($user);
        return $user->createToken($userToken, [$ability])->plainTextToken;
    }

}
