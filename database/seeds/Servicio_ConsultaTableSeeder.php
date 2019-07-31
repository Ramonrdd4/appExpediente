<?php

use Illuminate\Database\Seeder;

class Servicio_ConsultaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicio__consultas= App\servicio__consultas::create([
            'id_doctor'=> 3,
            'especialidad_id'=>1,
            'Precio'=>20000,
            'Ubicacion'=> 'Naranjo Centro, Frente al pollazo'

        ]);
        $servicio__consultas->save();
        
        $servicio__consultas= App\servicio__consultas::create([
            'id_doctor'=> 3,
            'especialidad_id'=>2,
            'Precio'=>25000,
            'Ubicacion'=> 'Naranjo Centro, Frente al pollazo'

        ]);
        $servicio__consultas->save();
    }
}
