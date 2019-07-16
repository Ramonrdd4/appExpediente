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
            $table->unsignedInteger('id_Usuario');
            $table->foreign('id_Usuario')->references('id')->on('users');
            $table->unsignedInteger('id_fumado');
            $table->foreign('id_fumado')->references('id')->on('fumados');
            $table->unsignedInteger('id_alcoholismo');
            $table->foreign('id_alcoholismo')->references('id')->on('alcohols');

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
        Schema::dropIfExists('expedientes');
    }
}
