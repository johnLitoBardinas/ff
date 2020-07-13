<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;

class CreateCustomerPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_package', function (Blueprint $table) {
            $table->bigIncrements('customer_package_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('reference_no');
            $table->enum('customer_package_status', ['active', 'expired', 'completed']);
            $table->tinyInteger('total_consumable_visits')->default(Config::get('constant.package_visits_limit'));
            $table->enum('payment_type', ['gcash', 'paymaya', 'card']);
            $table->timestamp('customer_package_start')->useCurrent();
            $table->timestamp('customer_package_end')->default(Carbon::now()->addDays(Config::get('constant.package_duration_days')));

            // Foreign keys
            $table->foreign('branch_id')->references('branch_id')->on('branch');
            $table->foreign('package_id')->references('package_id')->on('package');
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('customer_id')->references('customer_id')->on('customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_package', function (Blueprint $table) {
            $table->dropForeign('customer_package_branch_id_foreign');
            $table->dropForeign('customer_package_package_id_foreign');
            $table->dropForeign('customer_package_user_id_foreign');
            $table->dropForeign('customer_package_customer_id_foreign');
        });
    }
}
