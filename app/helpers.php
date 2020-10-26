<?php

use App\Enums\AccessHomeType;
use App\Enums\BranchType;
use App\User;

if (! function_exists('generate_branch_code')) {
    /**
     *  This will generate branch code => branch ID
     */
    function generate_branch_code()
    {
        return strtolower('FAF-' . strtotime(now()));
    }
}

if (! function_exists('generate_user_token')) {
   /**
    *  Used  for creating the user Token.
    *
    *  Generating custom 'first_name+last_name'.
    */
    function generate_user_token(User $user)
    {
        return strtolower($user->first_name . $user->last_name);
    }
}

if (! function_exists('generate_session_data')) {
   /**
    *  Generating the user sessions.
    */
    function generate_session_data(string $apiToken, string $logo, string $homeUrl, $userAccessType = null)
    {
        // Default session for the user.
        $sessionData = [
            'apiToken' => $apiToken,
            'logo' => $logo,
            'homeUrl' => $homeUrl,
        ];

        // Register a user access type for salon, gym, spa only in Manager/ Cashier Type.
        if (! is_null($userAccessType)) {
            $sessionData['userAccessType'] = $userAccessType;
        }

        session($sessionData);
    }
}

if (! function_exists('pikaday_date_format')) {
    /**
     *  Format the timestamp to a valid Constant Pikaday Format.
     */
    function pikaday_date_format(string $timestamp)
    {
        return date('Y-m-d', strtotime($timestamp));
    }
}

if (! function_exists('create_access_token')) {
    /**
     *  Generating API Token for the Client Application.
     */
    function create_access_token(User $user, string $ability)
    {
        $userToken = generate_user_token($user);
        return $user->createToken($userToken, [$ability])->plainTextToken;
    }
}

if (! function_exists('get_account_home_page')) {
    /**
     *  Determing if the Access Page is for Admin, Salon, Gym, Spa.
     */
    function get_account_home_page(string $requestedAccessPage)
    {
        switch ($requestedAccessPage) {
            case AccessHomeType::FFCO:
                return BranchType::ADMIN;
                break;

            case AccessHomeType::FFSALON:
                return BranchType::SALON;
                break;

            case AccessHomeType::FFGYM:
                return BranchType::GYM;
                break;

            case AccessHomeType::FFWELLNESS:
                return BranchType::SPA;
                break;
        }
    }
}

if (! function_exists('get_account_page_logo')) {
    /**
     *  Getting the appropriate logo for the Admin, Manager, Cashier [Salon, Gym, Spa] Logo.
     */
    function get_account_page_logo(User $user)
    {
        if ($user->isAdmin() || $user->isSuperAdmin()) {
            return config('constant.fnf_co_logo');
        }

        if ($user->branchType() === BranchType::SALON) {
            return config('constant.fnf_salon_logo');
        }

        if ($user->branchType() === BranchType::GYM) {
            return config('constant.fnf_gym_logo');
        }

        if ($user->branchType() === BranchType::SPA) {
            return config('constant.fnf_spa_logo');
        }
    }
}

if (! function_exists('login_user_redirection')) {

    /**
     *  Determine the proper user session storage and redirections.
     */
    function login_user_redirection(string $requestedHomeType, User $user)
    {
        $logo = get_account_page_logo($user);

        $redirectedUrl = route('login');

        if ($requestedHomeType === AccessHomeType::FFCO && $user->isAdmin() || $user->isSuperAdmin()) {
            $redirectedUrl = route('admin');
            $apiToken = create_access_token($user, 'user:admin');
            generate_session_data($apiToken, $logo, route('admin'));
            return $redirectedUrl;
        }

        $redirectedUrl = route('home');
        $apiToken = create_access_token($user, 'user:mgr');

        generate_session_data($apiToken, $logo, route('home'), $user->branchType());

        return $redirectedUrl;
    }
}
