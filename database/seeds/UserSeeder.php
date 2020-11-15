<?php

use App\Branch;
use App\Enums\BranchType;
use App\User;
use App\Enums\UserStatus;
use App\Enums\UserType;
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

        $superAdminBranchId = Branch::where('branch_type', BranchType::SUPER_ADMIN)->first()->branch_id;
        $superAdminRoleId = Role::where('name', UserType::SUPER_ADMIN)->first()->role_id;

        // $salonBranchId = Branch::where('branch_type', BranchType::SALON)->first()->branch_id;
        // $managerRoleId = Role::where('name', UserType::MANAGER)->first()->role_id;


       User::create([
            'email' => config('constant.super_admin_email'),
            'password' => Hash::make('password'),
            'first_name' => 'Super Admin',
            'last_name' => 'User',
            'mobile_number' => '09123456789',
            'user_status' => UserStatus::ACTIVE,
            'branch_id' => $superAdminBranchId,
            'role_id' => $superAdminRoleId,
        ]);

        // User::create([
        //     'email' => 'salon@ff.com',
        //     'password' => Hash::make('password'),
        //     'first_name' => 'Salon Manager',
        //     'last_name' => 'User',
        //     'mobile_number' => '09123456789',
        //     'user_status' => UserStatus::ACTIVE,
        //     'branch_id' => $salonBranchId,
        //     'role_id' => $managerRoleId,
        // ]);

    }
}
