<?php

use App\Enums\GymVisitationType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGymVisitationTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('gym_visitation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_package_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('visitation_type', GymVisitationType::getValues());
            $table->timestamp('date')->useCurrent();

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
        Schema::table('gym_visitation', function (Blueprint $table) {
            $table->dropForeign('customer_visits_customer_package_id_foreign');
            $table->dropForeign('customer_visits_branch_id_foreign');
            $table->dropForeign('customer_visits_user_id_foreign');
        });

        Schema::dropIfExists('gym_visitation');
    }
}
