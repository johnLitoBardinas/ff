<?php

use App\Enums\CustomerPackageStatus;
use App\Enums\PackageType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;

class CreateCustomerPackageTable extends Migration
{

    public function up()
    {
        Schema::create('customer_package', function (Blueprint $table) {
            $table->bigIncrements('customer_package_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('reference_no');
            $table->enum('package_type', PackageType::getValues());
            $table->enum('payment_type', Config::get('constant.payment_options'));
            $table->enum('salon_package_status', CustomerPackageStatus::getValues())->default(CustomerPackageStatus::ACTIVE);
            $table->date('salon_package_start');
            $table->date('salon_package_end');
            $table->enum('gym_package_status', CustomerPackageStatus::getValues())->default(CustomerPackageStatus::ACTIVE);
            $table->date('gym_package_start');
            $table->date('gym_package_end');
            $table->enum('spa_package_status', CustomerPackageStatus::getValues())->default(CustomerPackageStatus::ACTIVE);
            $table->date('spa_package_start');
            $table->date('spa_package_end');

            // Foreign keys
            $table->foreign('branch_id')->references('branch_id')->on('branch');
            $table->foreign('package_id')->references('package_id')->on('package');
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('customer_id')->references('customer_id')->on('customer');
        });
    }

    public function down()
    {
        Schema::table('customer_package', function (Blueprint $table) {
            $table->dropForeign('customer_package_branch_id_foreign');
            $table->dropForeign('customer_package_package_id_foreign');
            $table->dropForeign('customer_package_user_id_foreign');
            $table->dropForeign('customer_package_customer_id_foreign');
        });

        Schema::dropIfExists('customer_package');
    }

}
