<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CustomerPackage;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Config;

$factory->define(CustomerPackage::class, function (Faker $faker) {
    return [
        'branch_id' => $faker->randomElement([1, 2, 3]),
        'package_id' => $faker->randomElement([1, 2, 3]),
        'user_id' => $faker->randomElement([1, 2, 3]),
        'customer_id' => $faker->randomElement([1,2,3]),
        'reference_no' => strtotime(now()),
        'payment_type' => $faker->randomElement(Config::get('constant.payment_options')),
    ];
});
