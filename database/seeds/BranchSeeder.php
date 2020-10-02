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
            'branch_code' => generate_branch_code(),
            'branch_name' => 'Super Admin Branch',
            'branch_address' => 'Location',
            'branch_type' => BranchType::SUPER_ADMIN,
        ]);

        // Branch::create([
        //     'branch_code' => 'FAF-123456789',
        //     'branch_name' => 'Test Salon Branch',
        //     'branch_address' => 'Location Address Unique',
        //     'branch_type' => BranchType::SALON,
        // ]);

    }

}
