<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CustomerVisits;
use Faker\Generator as Faker;

$factory->define(CustomerVisits::class, function (Faker $faker) {
    return [
        // 'customer_package_id' => $faker->,
        // 'branch_id' => $faker->,
        // 'user_id' => $faker-> ,
        // 'date' => $faker->,
        // 'customer_associate' => $faker->,
        // 'customer_associate_picture' => $faker->,
    ];
});
