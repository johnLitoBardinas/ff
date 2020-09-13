<?php

use App\Enums\BranchType;
use App\Package;
use Faker\Generator as Faker;

$factory->define(Package::class, function (Faker $faker) {
    return [
        'package_name' => $faker->word,
        'package_price' => $faker->randomNumber(),
        'package_type' => $faker->randomElement(BranchType::getValues()),
        'salon_no_of_visits' => $faker->randomElement([1,2,3,4]),
        'salon_days_valid_count' => $faker->numberBetween(6,60),
        'gym_no_of_visits' => $faker->randomElement([1,2,3,4]),
        'gym_days_valid_count' => $faker->numberBetween(6,60),
        'spa_no_of_visits' => $faker->randomElement([1,2,3,4]),
        'spa_days_valid_count' => $faker->numberBetween(6,60),
    ];
});
