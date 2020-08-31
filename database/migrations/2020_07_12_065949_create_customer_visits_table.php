<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerVisitsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customer_visits', function (Blueprint $table) {
            $table->bigIncrements('customer_visits_id');
            $table->unsignedBigInteger('customer_package_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('date')->useCurrent();
            $table->string('customer_associate')->nullable();
            $table->string('customer_associate_picture')->nullable();

            // Foreign Keys
            $table->foreign('customer_package_id')->references('customer_package_id')->on('customer_package');
            $table->foreign('branch_id')->references('branch_id')->on('branch');
            $table->foreign('user_id')->references('user_id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('customer_visits', function (Blueprint $table) {
            $table->dropForeign('customer_visits_customer_package_id_foreign');
            $table->dropForeign('customer_visits_branch_id_foreign');
            $table->dropForeign('customer_visits_user_id_foreign');
        });

        Schema::dropIfExists('customer_visits');
    }
}
