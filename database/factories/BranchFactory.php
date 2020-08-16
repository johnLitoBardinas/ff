<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'branch_code' => strtolower( 'FAF-' . strtotime(now()) ),
        'branch_name' => $faker->word,
        'branch_address' => $faker->address,
    ];
});
