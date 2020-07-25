<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchTable extends Migration
{
    public function up()
    {
        Schema::create('branch', function (Blueprint $table) {
            $table->bigIncrements('branch_id');
            $table->string('branch_code')->unique();
            $table->string('branch_name');
            $table->longText('branch_address');
            $table->enum('branch_status', ['active', 'inactive'])->default('active');
            $table->string('region_code');
            $table->string('province_code');
            $table->string('municipality_code');
            $table->string('barangay_psgc');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branch');
    }

}
