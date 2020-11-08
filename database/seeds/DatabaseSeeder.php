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
        // if (env('APP_ENV') === 'local') {
        //     $this->call(PackageSeeder::class);
        // }

    }
}
