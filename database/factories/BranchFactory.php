<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'branch_code' => $faker->word,
        'branch_name' => $faker->word,
        'branch_address' => $faker->address,
    ];
});
