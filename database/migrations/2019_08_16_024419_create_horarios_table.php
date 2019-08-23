<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Fecha_cita');
            $table->time('hora_cita');
            $table->boolean('estado')->default(false);//si se asigno esta en false y si esta disponible en true
            $table->unsignedInteger('id_servicioConsulta');
            $table->softDeletes();
            $table->timestamps();
            //foranea
            $table->foreign('id_servicioConsulta')->references('id')->on('servicio__consultas');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios');
    }
}
