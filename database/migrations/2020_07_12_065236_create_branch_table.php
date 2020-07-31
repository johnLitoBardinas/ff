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
            $table->string('branch_name')->unique();
            $table->string('branch_address', 191)->unique();
            $table->enum('branch_status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branch');
    }

}
