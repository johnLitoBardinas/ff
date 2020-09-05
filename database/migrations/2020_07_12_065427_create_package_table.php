<?php

use App\Enums\PackageStatus;
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
            $table->decimal('package_price');
            $table->enum('package_status', PackageStatus::getValues())->default(PackageStatus::INACTIVE);
            $table->tinyInteger('salon_no_of_visits')->unsigned();
            $table->tinyInteger('salon_days_valid_count')->unsigned();
            $table->tinyInteger('gym_no_of_visits')->unsigned()->default(0); // if 0 then it is only days
            $table->tinyInteger('gym_days_valid_count')->unsigned();
            $table->tinyInteger('spa_no_of_visits')->unsigned();
            $table->tinyInteger('spa_days_valid_count');
            $table->timestamps();
            $table->softDeletes();
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
