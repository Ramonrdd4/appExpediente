<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MedicamentosExpedientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamento_expediente', function (Blueprin $table){
            $table->increments('id');
            $table->integer('medicamento_id')->unsigned();
            $table->integer('expediente_id')->unsigned();
            $table->timestamps();
            //Llaves foraneas
            $table->foreign('medicamento_id')->references('id')->on('medicamentos');
            $table->foreign('expediente_id')->references('id')->on('expedientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicamento_expediente', function(Blueprint $table){
            $table->dropForeign('medicamento_expediente_medicamento_id_foreign');
            $table->dropColumn('medicamento_id');
            $table->dropForeign('medicamento_expediente_expediente_id_foreign');
            $table->dropColumn('expediente_id');
        });
        Schema::dropIfExists('medicamento_expediente');
    }
}
