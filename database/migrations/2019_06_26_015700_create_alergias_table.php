<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlergiasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alergias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('categoria'); //alimentos, medicamentos y ambiente
            $table->string('reaccion');
            $table->string('observaciones');
            $table->unsignedInteger('listaId')->nullable();
            //Relacion con lista
            $table->foreign('listaId')->references('id')->on('lista_alergias');
            $table->softDeletes();
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
        Schema::table('alergias', function (Blueprint $table){
            $table->dropForeign('alergias_listaId_foreign');
            $table->dropColumn('listaId');
        });
        Schema::dropIfExists('alergias');
    }
}
