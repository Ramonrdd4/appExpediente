<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('nombre');
            $table->string('primerApellido');
            $table->string('segundoApellido');
            $table->string('sexo');
            $table->date('fechaNacimiento');
            $table->string('tipoSangre');
            $table->string('direccion');
            $table->unsignedInteger('numTelefonico');
            $table->unsignedInteger('contactoEmergencia');
            //Laves foraneas
            $table->unsignedInteger('idUsuario');
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->unsignedInteger('idExpediente');
            $table->foreign('idExpediente')->references('id')->on('expedientes');
            //Identificador de dueño booleano
            $table->boolean('esDuenho');
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
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign('profiles_idUsuario_foreign');
            $table->dropColumn('idUsuario');
        });
        Schema::dropIfExists('profiles');
    }
}
