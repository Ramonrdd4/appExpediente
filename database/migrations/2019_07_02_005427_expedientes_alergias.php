<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpedientesAlergias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente_alergia', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('expediente_id');
            $table->unsignedInteger('alergia_id');
            $table->timestamps();
            //Llaves foraneas
            $table->foreign('expediente_id')->references('id')->on('expedientes');
            $table->foreign('alergia_id')->references('id')->on('alergias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expediente_alergia', function(Blueprint $table){
            $table->dropForeign('expediente_alergia_expediente_id_foreign');
            $table->dropColumn('expediente_id');
            $table->dropForeign('expediente_alergia_alergia_id_foreign');
            $table->dropColumn('alergia_id');
        });
        Schema::dropIfExists('expediente_alergia');
    }
}
