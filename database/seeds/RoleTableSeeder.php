<?php

use App\Enums\UserType;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Role::create([ 'name' => UserType::SUPER_ADMIN ]);
        Role::create([ 'name' => UserType::ADMIN ]);
        Role::create([ 'name' => UserType::MANAGER ]);
        Role::create([ 'name' => UserType::CASHIER ]);

    }

}
