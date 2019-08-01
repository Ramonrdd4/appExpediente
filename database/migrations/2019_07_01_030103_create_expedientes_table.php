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
            //$table->unsignedInteger('profile_id');
            $table->boolean('tieneAlergia');
            $table->boolean('tieneEnfermedadF');
            $table->boolean('tieneActividad');
            //foraneas

            $table->unsignedInteger('idfumado')->nullable();
            $table->unsignedInteger('idalcoholismo')->nullable();
            $table->timestamps();

            $table->foreign('idfumado')->references('id')->on('fumados');
            $table->foreign('idalcoholismo')->references('id')->on('alcohols');



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
            //$table->dropColumn('profile_id');
            $table->dropForeign('expedientes_idfumado_foreign');
            $table->dropColumn('idfumado');
            $table->dropForeign('expedientes_idalcoholismo_foreign');
            $table->dropColumn('idalcoholismo');
        });
        Schema::dropIfExists('expedientes');
    }
}
