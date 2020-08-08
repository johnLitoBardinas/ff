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

];
