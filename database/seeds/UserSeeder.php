<?php

use App\User;
use App\Enums\UserStatus;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

       User::create([
            'email' => 'admin@ff.com',
            'password' => Hash::make('password'),
            'first_name' => 'Admin',
            'last_name' => 'User',
            'user_status' => UserStatus::ACTIVE,
            'branch_id' => 1,
            'role_id' => 1,
        ]);

        User::create([
            'email' => 'manager@ff.com',
            'password' => Hash::make('password'),
            'first_name' => 'Manager',
            'last_name' => 'User',
            'user_status' => UserStatus::ACTIVE,
            'branch_id' => 2,
            'role_id' => 2,
        ]);

        User::create([
            'email' => 'cashier@ff.com',
            'password' => Hash::make('password'),
            'first_name' => 'Cashier',
            'last_name' => 'User',
            'user_status' => UserStatus::ACTIVE,
            'branch_id' => 3,
            'role_id' => 3,
        ]);

    }
}
