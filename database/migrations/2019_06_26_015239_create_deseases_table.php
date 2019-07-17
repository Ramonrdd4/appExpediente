<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deseases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('observaciones');
            $table->unsignedInteger('listaId')->nullable();
            //Relacion con lista
            $table->foreign('listaId')->references('id')->on('lista_deseases');
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
        Schema::table('deseases', function (Blueprint $table){
            $table->dropForeign('deseases_listaId_foreign');
            $table->dropColumn('listaId');
        });
        Schema::dropIfExists('deseases');
    }
}
