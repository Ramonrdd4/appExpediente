<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicioConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio__consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->double('precio');
            $table->string('ubicacion');
            $table->unsignedInteger('id_Doctor');
            $table->unsignedInteger('id_Especialidad');

            $table->timestamps();
            //foraneas
            $table->foreign('id_Especialidad')->references('id')->on('especialidades');
            $table->foreign('id_Doctor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio__consultas');
    }
}
