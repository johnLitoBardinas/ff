<?php

use App\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Branch::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // For Testing Mock Ids
        $mockIds = [ 1, 2, 3, 4, 5 ];

        Branch::create([
            'branch_code' => 'faf-1593789261',
            'branch_name' => 'Dian Makati 1',
            'branch_address' => '1741 Dian St. Palanan Makati City',
            'region_id' => $mockIds[array_rand($mockIds)],
            'province_id' => $mockIds[array_rand($mockIds)],
            'municipality_id' => $mockIds[array_rand($mockIds)],
            'barangay_id' => $mockIds[array_rand($mockIds)],
        ]);

        Branch::create([
            'branch_code' => 'faf-1593789262',
            'branch_name' => 'Dian Makati 2',
            'branch_address' => '1741s Dian St. Palanan Makati City',
            'region_id' => $mockIds[array_rand($mockIds)],
            'province_id' => $mockIds[array_rand($mockIds)],
            'municipality_id' => $mockIds[array_rand($mockIds)],
            'barangay_id' => $mockIds[array_rand($mockIds)],
        ]);

        Branch::create([
            'branch_code' => 'faf-1593789264',
            'branch_name' => 'Dian Makati 3',
            'branch_address' => '174143 Dian St. Palanan Makati City',
            'region_id' => $mockIds[array_rand($mockIds)],
            'province_id' => $mockIds[array_rand($mockIds)],
            'municipality_id' => $mockIds[array_rand($mockIds)],
            'barangay_id' => $mockIds[array_rand($mockIds)],
        ]);

    }
}
