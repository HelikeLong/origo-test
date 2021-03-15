<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_plan', function (Blueprint $table) {
            $table->integer('client_id');
            $table->integer('plan_id')->index('client_plan_FK_1');
            $table->unique(['client_id', 'plan_id'], 'client_plan_UN');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_plan');
    }
}
