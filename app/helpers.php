<?php

use App\Enums\UserStatus;
use App\Enums\UserType;

if ( ! function_exists( 'is_valid_usertype' ) ) {

    /**
     * Checking if the user type is valid.
     */
    function is_valid_usertype( String $type )
    {
        return in_array( $type, UserType::getValues() );
    }

}

if ( ! function_exists( 'is_valid_user_status' ) ) {

    /**
     * Checking if the user status is valid.
     */
    function is_valid_user_status( String $status )
    {
        // return $status->in( [ UserStatus::ACTIVE, UserStatus::INACTIVE ] );
        return in_array( $status, UserStatus::getValues() );
    }

}