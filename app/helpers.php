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

if ( ! function_exists( 'renderSelect' ) ) {

    /**
     * Redenring the collection and assigning the right selected value
     */
    function renderSelect(Array $options, String $selected, String $keyName)
    {
        $key = $keyName != 'barangay' ? $keyName . '_code' : 'psgc_code';
        $name = $keyName != 'barangay' ? $keyName . '_name' : 'barangay_name';

        $html = '';
        foreach ($options as $option) {

            if ( $option[$key] === $selected) {
                $html .= '<option value="'.$option[$key].'" selected>'.$option[$name].'</option>';
            } else {
                $html .= '<option value="'.$option[$key].'">'.$option[$name].'</option>';
            }

        }

        return $html;

    }

}