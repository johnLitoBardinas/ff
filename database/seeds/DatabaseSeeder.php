<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PackageSeeder::class);
        // $this->call(CustomerSeeder::class);
        // $this->call(CustomerPackageSeeder::class);
        // $this->call(CustomerVisitsSeeder::class);
    }
}
