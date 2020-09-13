<?php

use App\CustomerPackage;
use App\Enums\PackageStatus;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Config;

$factory->define(CustomerPackage::class, function (Faker $faker) {
    return [
        'branch_id' => $faker->randomElement([1,2,3]),
        'package_id' => $faker->randomElement([1,2,3]),
        'user_id' => $faker->randomElement([1,2,3]),
        'customer_id' => $faker->randomElement([1,2,3]),
        'reference_no' => strtotime(now()),
        'payment_type' => $faker->randomElement(Config::get('constant.payment_options')),
        'salon_package_status' => $faker->randomElement(PackageStatus::getValues()),
        'salon_package_start' => Carbon::now()->toDateString(),
        'salon_package_end' => Carbon::now()->addDays(60)->toDateString(),
        'gym_package_status' => $faker->randomElement(PackageStatus::getValues()),
        'gym_package_start' => Carbon::now()->toDateString(),
        'gym_package_end' => Carbon::now()->addDays(5)->toDateString(),
        'spa_package_status' => $faker->randomElement(PackageStatus::getValues()),
        'spa_package_start' => Carbon::now()->toDateString(),
        'spa_package_end' => Carbon::now()->addDays(5)->toDateString(),
    ];
});
