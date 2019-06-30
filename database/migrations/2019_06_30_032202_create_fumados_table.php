<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFumadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fumados', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('estadoFumado');
            $table->string('tiempoInicio');
            $table->unsignedInteger('frecuencia');
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
        Schema::table('fumados', function (Blueprint $table) {
            $table->dropForeign('expedientes_id_foreign');
        });
        Schema::dropIfExists('fumados');
    }
}
