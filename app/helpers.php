<?php

use App\Enums\UserStatus;
use App\Enums\UserType;

if ( ! function_exists( 'is_valid_usertype' ) ) {

    /**
     * Checking if the user type is valid.
     */
    function is_valid_usertype( UserType $type )
    {
        return $type->in( [ UserType::ADMIN, UserType::MANAGER, UserType::CASHIER ] );
    }

}

if ( ! function_exists( 'is_valid_user_status' ) ) {

    /**
     * Checking if the user status is valid.
     */
    function is_valid_user_status( UserStatus $status )
    {
        return $status->in( [ UserStatus::ACTIVE, UserStatus::INACTIVE ] );
    }

}