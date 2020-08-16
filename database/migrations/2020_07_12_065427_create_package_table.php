<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package', function (Blueprint $table) {
            $table->bigIncrements('package_id');
            $table->string('package_name')->unique();
            $table->string('package_description');
            $table->decimal('package_price');
            $table->timestamps();
        });

        Schema::table('package', function (Blueprint $table)
        {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package', function (Blueprint $table)
        {
            $table->dropSoftDeletes();
        });

        Schema::dropIfExists('package');
    }
}
