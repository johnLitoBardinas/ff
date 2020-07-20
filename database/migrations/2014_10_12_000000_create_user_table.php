<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('user_status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

        });

        // Schema::table('user', function (Blueprint $table)
        // {
        //     $table->foreign('role_id')->references('role_id')->on('role');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('user', function (Blueprint $table)
        // {
        //     $table->dropForeign('user_role_id_foreign');
        // });
        Schema::dropIfExists('user');
    }
}
