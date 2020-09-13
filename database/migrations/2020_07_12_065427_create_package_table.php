<?php

use App\Enums\BranchType;
use App\Enums\PackageStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTable extends Migration
{

    public function up()
    {
        Schema::create('package', function (Blueprint $table) {
            $table->bigIncrements('package_id');
            $table->string('package_name')->unique();
            $table->string('package_price', 9);
            $table->enum('package_status', PackageStatus::getValues())->default(PackageStatus::INACTIVE);
            $table->enum('package_type', BranchType::getValues());
            $table->tinyInteger('salon_no_of_visits')->unsigned(); // visitation (number) for salon.
            $table->tinyInteger('salon_days_valid_count')->unsigned(); // number of days that the valid will be valid
            $table->tinyInteger('gym_no_of_visits')->unsigned()->default(0); // if 0 then it is only days
            $table->tinyInteger('gym_days_valid_count')->unsigned();
            $table->tinyInteger('spa_no_of_visits')->unsigned();
            $table->tinyInteger('spa_days_valid_count');
            $table->timestamps();
        });

        Schema::table('package', fn(Blueprint $table) => $table->softDeletes());
    }

    public function down()
    {
        Schema::table('package', fn(Blueprint $table) => $table->dropSoftDeletes());
        Schema::dropIfExists('package');
    }

}
