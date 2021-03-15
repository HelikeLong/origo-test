<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClientPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_plan', function (Blueprint $table) {
            $table->foreign('client_id', 'client_plan_FK')->references('id')->on('clients')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('plan_id', 'client_plan_FK_1')->references('id')->on('plans')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_plan', function (Blueprint $table) {
            $table->dropForeign('client_plan_FK');
            $table->dropForeign('client_plan_FK_1');
        });
    }
}
