<?php

return [

    /*
    |--------------------------------------------------------------------------
    | FixAndFree CONSTANTS
    |--------------------------------------------------------------------------
    |
    | Here you may add additional constant to be access by the application.
    |
    */

    'package_visits_limit' => env('PACKAGE_VISITS_LIMIT', 4),
    'package_duration_days' => env('PACKAGE_DURATION_DAYS', 60),
    'default_user_password' => env('DEFAULT_USER_PASSWORD'), // for security hidden to the environment variable

    'fix_and_free_co_logo' => 'svg/fixandfree.co_logo_horizontal.svg',
    'fix_and_free_salon_logo' => 'svg/fixandfree.salon_logo_horizontal.svg',

];
