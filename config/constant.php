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
    'default_user_password' => env('DEFAULT_USER_PASSWORD'), // for security hidden to the environment variable
    'super_admin_email' => env('SUPER_ADMIN_EMAIL'),
    'main_branch' => 'Main Branch',
    'fnf_co_logo' => 'svg/fandf.co_horizontal.svg',
    'fnf_salon_logo' => 'svg/fixandfree.salon_logo_horizontal.svg', // logo for the salon account type
    'fnf_gym_logo' => 'svg/fitandfree.gym_logo_horizontal.svg', // logo for the gym account type
    'fnf_spa_logo' => 'svg/fabandfree.wellness_logo_horizontal.svg', // logo for the spa account type

    'payment_options' => [ 'gcash', 'paymaya', 'card'],
];
