<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhilippinesAdressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('region')->insert(json_decode(file_get_contents( dirname(__FILE__) . '/philippines_address/regions.json'), true));
        DB::table('province')->insert(json_decode(file_get_contents( dirname(__FILE__) . '/philippines_address/province.json'), true));
        DB::table('municipality')->insert(json_decode(file_get_contents( dirname(__FILE__) . '/philippines_address/municipality.json'), true));
        DB::table('barangay')->insert(json_decode(file_get_contents( dirname(__FILE__) . '/philippines_address/barangay.json'), true));
    }
}
