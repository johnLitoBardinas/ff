<?php

use App\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{

    public function run()
    {
        factory(Package::class, 1)->create();
    }

}

