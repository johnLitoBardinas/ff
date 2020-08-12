<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Package;
use Faker\Generator as Faker;

$factory->define(Package::class, function (Faker $faker) {
    return [
        'package_name' => $faker->word,
        'package_description' => $faker->text,
        'package_price' => number_format((float) $faker->randomFloat(2, 1, 9999), 2, '.', ''),
    ];
});
