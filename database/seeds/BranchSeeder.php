<?php

use App\Branch;
use App\Enums\BranchType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Branch::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Branch::create([
            'branch_code' => 'faf-1593789261',
            'branch_name' => 'Admin Branch',
            'branch_address' => 'Location',
            'branch_type' => BranchType::SALON,
        ]);

        // Branch::create([
        //     'branch_code' => 'faf-1593789262',
        //     'branch_name' => 'Dian Makati 2',
        //     'branch_address' => '1741s Dian St. Palanan Makati City',
        //     'branch_type' => BranchType::GYM,
        // ]);

        // Branch::create([
        //     'branch_code' => 'faf-1593789264',
        //     'branch_name' => 'Dian Makati 3',
        //     'branch_address' => '174143 Dian St. Palanan Makati City',
        //     'branch_type' => BranchType::SALON,
        // ]);

    }

}
