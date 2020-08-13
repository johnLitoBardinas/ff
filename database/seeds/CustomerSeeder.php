<?php

use App\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(Customer::class, 5)->create();
    }
}
