<?php
/**
 * Utility Functions.
 */

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

