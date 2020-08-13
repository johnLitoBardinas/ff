<?php

use App\CustomerPackage;
use Illuminate\Database\Seeder;

class CustomerPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(CustomerPackage::class, 5)->create();
    }
}
