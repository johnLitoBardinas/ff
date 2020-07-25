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

        $makatiBrgys = ['137602015', '137602002', '137602008'];
        /**
         * 13 => NCR
         * 1376 => NCR, FORTH DISTRICT
         * 137602 => CITY OF MAKATI
         * [
         * 137602015 => Palanan
         * 137602002 =>  Bel Air
         * 137602008 => Forbes Park
         * ]
         *
         */


        Branch::create([
            'branch_code' => 'faf-1593789261',
            'branch_name' => 'Dian Makati 1',
            'branch_address' => '1741 Dian St. Palanan Makati City',
            'region_code' => '13',
            'province_code' => '1376',
            'municipality_code' => '137602',
            'barangay_psgc' => $makatiBrgys[array_rand($makatiBrgys)],
        ]);

        Branch::create([
            'branch_code' => 'faf-1593789262',
            'branch_name' => 'Dian Makati 2',
            'branch_address' => '1741s Dian St. Palanan Makati City',
            'region_code' => '13',
            'province_code' => '1376',
            'municipality_code' => '137602',
            'barangay_psgc' => $makatiBrgys[array_rand($makatiBrgys)],
        ]);

        Branch::create([
            'branch_code' => 'faf-1593789264',
            'branch_name' => 'Dian Makati 3',
            'branch_address' => '174143 Dian St. Palanan Makati City',
            'region_code' => '13',
            'province_code' => '1376',
            'municipality_code' => '137602',
            'barangay_psgc' => $makatiBrgys[array_rand($makatiBrgys)],
        ]);

    }
}
