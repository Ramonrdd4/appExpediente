<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpedientesActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente_activity', function (Blueprin $table){
            $table->increments('id');
            $table->integer('expediente_id')->unsigned();
            $table->integer('activity_id')->unsigned();
            $table->integer('minutos')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->timestamps();
            //Llaves foraneas
            $table->foreign('expediente_id')->references('id')->on('expedientes');
            $table->foreign('activity_id')->references('id')->on('activities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expediente_activity', function(Blueprint $table){
            $table->dropForeign('expediente_activity_expediente_id_foreign');
            $table->dropColumn('expediente_id');
            $table->dropForeign('expediente_activity_activity_id_foreign');
            $table->dropColumn('activity_id');
        });
        Schema::dropIfExists('expediente_activity');
    }
}