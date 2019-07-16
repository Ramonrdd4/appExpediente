<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFumadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fumados', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('estadoFumado'); // 1 = Fuma, 2 = Fumaba, 3=No fuma
            $table->string('tiempoInicio');// Valores como: Menos de un mes, mas de un mes, mas de 3 meses, mas de 6 meses, Mas de 1 año, Mas de 3 años, Mas de 5 años y N/A.
            $table->unsignedInteger('frecuencia'); //Cantidad de cigarros por semana, promedio.
            $table->string('observaciones');
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
        Schema::dropIfExists('fumados');
    }
}
