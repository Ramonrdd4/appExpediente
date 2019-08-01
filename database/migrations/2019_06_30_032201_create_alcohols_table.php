<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlcoholsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alcohols', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('estadoAlcohol'); // 1. Toma, 2. Tomaba, 3. No toma
            $table->string('tiempoInicio'); // Medido en valores como, Menos de un mes, mas de un mes, mas de 3 mese, mas de 6 meses, mas de 1 año, mas de 3 años, mas de 5 años y N/A
            $table->unsignedInteger('frecuencia');//Cantidad de veces que toma por semana, promedio
            $table->string('tipoLicor');
            $table->unsignedInteger('cantidad');// medido en militros.
            $table->string('Observaciones');
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

        Schema::dropIfExists('alcohols');
    }
}
