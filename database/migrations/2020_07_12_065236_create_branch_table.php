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
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('municipality_id');
            $table->unsignedBigInteger('barangay_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branch');
    }

}
