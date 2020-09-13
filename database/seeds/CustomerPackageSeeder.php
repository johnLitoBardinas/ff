<?php

use App\CustomerPackage;
use Illuminate\Database\Seeder;

class CustomerPackageSeeder extends Seeder
{

    public function run()
    {
        factory(CustomerPackage::class, 5)->create();
    }

}
