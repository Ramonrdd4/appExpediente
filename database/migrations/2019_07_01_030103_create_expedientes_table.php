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
            $table->unsignedInteger('id_perfil');
            $table->unsignedInteger('id_fumado');
            $table->unsignedInteger('id_alcoholismo');




            $table->foreign('id_fumado')->references('id')->on('fumados');
            $table->foreign('id_alcoholismo')->references('id')->on('alcohols');
            $table->foreign('id_perfil')->references('id')->on('profiles');
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
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropForeign('expedientes_id_perfil_foreign');
            $table->dropColumn('id_perfil');
            $table->dropForeign('expedientes_id_fumado_foreign');
            $table->dropColumn('id_fumado');
            $table->dropForeign('expedientes_id_alcoholismo_foreign');
            $table->dropColumn('id_alcoholismo');
        });
        Schema::dropIfExists('expedientes');
    }
}
