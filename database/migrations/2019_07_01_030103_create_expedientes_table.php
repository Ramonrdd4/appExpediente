<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            //foraneas
            $table->unsignedInteger('idperfil');
            $table->unsignedInteger('idfumado');
            $table->unsignedInteger('idalcoholismo');
            $table->timestamps();

            $table->foreign('idfumado')->references('id')->on('fumados');
            $table->foreign('idalcoholismo')->references('id')->on('alcohols');
            $table->foreign('idperfil')->references('id')->on('profiles');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropForeign('expedientes_idperfil_foreign');
            $table->dropColumn('idperfil');
            $table->dropForeign('expedientes_idfumado_foreign');
            $table->dropColumn('idfumado');
            $table->dropForeign('expedientes_idalcoholismo_foreign');
            $table->dropColumn('idalcoholismo');
        });
        Schema::dropIfExists('expedientes');
    }
}