<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('nombre');
            //Relacion con lista
            $table->foreign('listaId')->references('id')->on('lista_activities');
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
        Schema::table('activities', function (Blueprint $table){
            $table->dropForeign('activities_listaId_foreign');
            $table->dropColumn('listaId');
        });
        Schema::dropIfExists('activities');
    }
}
