<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlcoholsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alcohols', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('estadoAlcohol');
            $table->string('tiempoInicio');
            $table->unsignedInteger('frecuencia');
            $table->string('tipoLicor');
            $table->unsignedInteger('cantidad');
            //Llave foranea
            $table->foreign('id')->references('id')->on('expedientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alcohols', function (Blueprint $table) {
            $table->dropForeign('expedientes_id_foreign');
        });
        Schema::dropIfExists('alcohols');
    }
}
