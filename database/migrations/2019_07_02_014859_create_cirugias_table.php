<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCirugiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cirugias', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->string('lugar');
            $table->unsignedInteger('idExpediente');
            $table->timestamps();
            //Llave foranea.
            $table->foreign('idExpediente')->references('id')->on('expedientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cirugias', function (Blueprint $table) {
            $table->dropForeign('cirugias_expedienteId_foreign');
            $table->dropColumn('idExpediente');
        });
        Schema::dropIfExists('cirugias');
    }
}
