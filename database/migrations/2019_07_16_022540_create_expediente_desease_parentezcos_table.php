<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedienteDeseaseParentezcosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente_desease_parentezcos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_Expediente');
            $table->unsignedInteger('id_parentezco');
            $table->timestamps();
            //Llave foranea.
            $table->foreign('id_Expediente')->references('id')->on('expedientes');
            $table->foreign('id_parentezco')->references('id')->on('parentezcos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expediente_desease_parentezcos');
    }
}
