<?php

use Illuminate\Database\Seeder;

class HorarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Horario= App\Horario::create([
            'Fecha_cita'=> '2019-08-20',
            'hora_cita'=>'15:00',
            'id_servicioConsulta'=>1,
            'estado'=>true
        ]);
        $Horario->save();
        $Horario= App\Horario::create([
            'Fecha_cita'=> '2019-08-20',
            'hora_cita'=>'15:30',
            'id_servicioConsulta'=>1,
            'estado'=>true
        ]);
        $Horario->save();
        $Horario= App\Horario::create([
            'Fecha_cita'=> '2019-08-20',
            'hora_cita'=>'16:00',
            'id_servicioConsulta'=>1,
            'estado'=>true
        ]);
        $Horario->save();
        $Horario= App\Horario::create([
            'Fecha_cita'=> '2019-08-20',
            'hora_cita'=>'15:00',
            'id_servicioConsulta'=>2,
            'estado'=>true
        ]);
        $Horario->save();
        $Horario= App\Horario::create([
            'Fecha_cita'=> '2019-08-20',
            'hora_cita'=>'15:30',
            'id_servicioConsulta'=>2,
            'estado'=>true
        ]);
        $Horario->save();
        $Horario= App\Horario::create([
            'Fecha_cita'=> '2019-08-20',
            'hora_cita'=>'16:00',
            'id_servicioConsulta'=>2,
            'estado'=>true
        ]);
        $Horario->save();
    }
}
