<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CustomerVisits;
use Faker\Generator as Faker;

$factory->define(CustomerVisits::class, function (Faker $faker) {
    return [
        'customer_package_id' => $faker->randomElement([1,2,3]),
        'branch_id' => $faker->randomElement([1,2,3]),
        'user_id' => $faker->randomElement([1,2,3]),
        'customer_associate' => $faker->name,
        'customer_associate_picture' => $faker->imageUrl($width=640, $height=480),
    ];
});
