<?php

use App\Enums\UserStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{

    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile_number');
            $table->enum('user_status', UserStatus::getValues())->default(UserStatus::ACTIVE);
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }

}
