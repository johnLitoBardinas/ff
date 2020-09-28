<?php

use App\Enums\AccessHomeType;
use App\Enums\BranchType;
use App\User;

if ( ! function_exists( 'generate_branch_code' ) ) {

    /**
    * This will generate branch code => branch ID
    */
    function generate_branch_code()
    {
      return strtolower( 'FAF-' . strtotime(now()) );
    }
 }

if ( ! function_exists( 'generate_user_token' ) ) {

  /**
   * Used  for creating the user Token.
   *
   * Generating custom 'first_name+last_name'.
   */
  function generate_user_token(User $user)
  {
    return strtolower( $user->first_name . $user->last_name );
  }

}

if ( ! function_exists( 'generate_session_data' ) ) {

  /**
   * Generating the user sessions.
   */
  function generate_session_data(String $apiToken, String $logo, String $homeUrl, $userAccessType = null)
  {
    $sessionData = [
      'apiToken' => $apiToken,
      'logo' => $logo,
      'homeUrl' => $homeUrl,
    ];

    if (! is_null($userAccessType) ) {
      $sessionData['userAccessType'] = $userAccessType;
    }

    session()->regenerate();
    session($sessionData);
  }

}

if ( ! function_exists( 'pikaday_date_format' ) ) {

  /**
   * Format the timestamp to a valid Constant Pikaday Format.
   */
  function pikaday_date_format(String $timestamp)
  {
    return date('Y-m-d', strtotime($timestamp));
  }

}

if ( ! function_exists( 'create_access_token' ) ) {

  /**
   * Generating API Token for the Client Application.
   */
  function create_access_token(User $user, String $ability)
  {
      $userToken = generate_user_token($user);
      return $user->createToken($userToken, [$ability])->plainTextToken;
  }

}

if ( ! function_exists( 'login_user_redirection' ) ) {

  /**
   * Determine the proper user session storage and redirections.
   */
  function login_user_redirection(String $requestedHomeType, User $user)
  {
    // dump($requestedHomeType);
    // dump($user->branchType());
    // dd($user);
    $redirectedUrl = route('login');

    if ($requestedHomeType === AccessHomeType::FFCO && $user->isAdmin() || $user->isSuperAdmin())  {
        $redirectedUrl = route('admin');
        $apiToken = create_access_token($user, 'user:admin');
        generate_session_data($apiToken, config('constant.fnf_co_logo'), route('admin'));
        return $redirectedUrl;
    }

    $redirectedUrl = route('home');
    $apiToken = create_access_token($user, 'user:mgr');

    if ($user->branchType() === BranchType::SALON) {
      generate_session_data($apiToken, config('constant.fnf_salon_logo'), route('home'), $user->branchType());
    }

    if ($user->branchType() === BranchType::GYM) {
      generate_session_data($apiToken, config('constant.fnf_gym_logo'), route('home'), $user->branchType());
    }

    if ($user->branchType() === BranchType::SPA) {
      generate_session_data($apiToken, config('constant.fnf_spa_logo'), route('home'), $user->branchType());
    }

    return $redirectedUrl;

  }

}
