<?php

use App\Branch;
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

        // Roles
        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', 'manager')->first();
        $cashierRole = Role::where('name', 'cashier')->first();

        // Branch Ids
        $branchIds = Branch::where('branch_id', '>', '0')->pluck('branch_id')->toArray();

       User::create([
            'email' => 'admin@ff.com',
            'password' => Hash::make('password'),
            'first_name' => 'Admin',
            'last_name' => 'User',
            'user_status' => UserStatus::ACTIVE,
            'branch_id' => $branchIds[array_rand($branchIds)],
            'role_id' => $adminRole->role_id,
        ]);

        User::create([
            'email' => 'manager@ff.com',
            'password' => Hash::make('password'),
            'first_name' => 'Manager',
            'last_name' => 'User',
            'user_status' => UserStatus::ACTIVE,
            'branch_id' => $branchIds[array_rand($branchIds)],
            'role_id' => $managerRole->role_id,
        ]);

        User::create([
            'email' => 'cashier@ff.com',
            'password' => Hash::make('password'),
            'first_name' => 'Cashier',
            'last_name' => 'User',
            'user_status' => UserStatus::ACTIVE,
            'branch_id' => $branchIds[array_rand($branchIds)],
            'role_id' => $cashierRole->role_id,
        ]);

    }
}
