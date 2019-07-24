<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpedientesDeseases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente_desease', function (Blueprint $table){
            $table->increments('id');
            $table->integer('expediente_id')->unsigned();
            $table->integer('desease_id')->unsigned();
            $table->string('parentezco')->nullable();
            $table->timestamps();
            //Llaves foraneas
            $table->foreign('expediente_id')->references('id')->on('expedientes');
            $table->foreign('desease_id')->references('id')->on('deseases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expediente_desease', function(Blueprint $table){
            $table->dropForeign('expediente_desease_expediente_id_foreign');
            $table->dropColumn('expediente_id');
            $table->dropForeign('expediente_desease_desease_id_foreign');
            $table->dropColumn('desease_id');
        });
        Schema::dropIfExists('expediente_desease');
    }
}
