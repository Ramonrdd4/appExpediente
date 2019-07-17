<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('estado_cita');
            $table->unsignedInteger('id_perfil');
            $table->unsignedInteger('id_Horario');
            $table->timestamps();

            $table->foreign('id_Horario')->references('id')->on('horarios');
            $table->foreign('id_perfil')->references('id')->on('profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agendas', function(Blueprint $table){
            $table->dropForeign('agendas_id_horario_foreign');
            $table->dropColumn('id_Horario');
            $table->dropForeign('agendas_id_perfil_foreign');
            $table->dropColumn('id_perfil');
        });
        Schema::dropIfExists('agendas');
    }
}
