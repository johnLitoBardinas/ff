<?php

use App\CustomerVisits;
use Illuminate\Database\Seeder;

class CustomerVisitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CustomerVisits::class, 5)->create();
    }
}
