<?php

use Illuminate\Database\Seeder;
use App\Activity;


class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1.
        $activity= new App\Activity();
        $activity->nombre='Correr';
        $alergia->ruta_imagen ='Fabiola_actividad_1566079807.jpg';
        $activity->save();
        //2.
        $activity= new App\Activity();
        $activity->nombre='Natación';
        $alergia->ruta_imagen ='Fabiola_actividad_1566079832.jpeg';
        $activity->save();
        //3.
        $activity= new App\Activity();
        $activity->nombre='Basketball';
        $alergia->ruta_imagen ='Fabiola_actividad_1566079858.jpg';
        $activity->save();
        //4.
        $activity= new App\Activity();
        $activity->nombre='Soccer';
        $alergia->ruta_imagen ='Fabiola_actividad_1566079886.jpg';
        $activity->save();
        //5.
        $activity= new App\Activity();
        $activity->nombre='Ciclismo';
        $alergia->ruta_imagen ='Fabiola_actividad_1566079917.jpg';
        $activity->save();
        //6.
        $activity= new App\Activity();
        $activity->nombre='Triatlon';
        $alergia->ruta_imagen ='Fabiola_actividad_1566079947.jpg';
        $activity->save();
        //7.
        $activity= new App\Activity();
        $activity->nombre='yoga';
        $alergia->ruta_imagen ='Fabiola_actividad_1566079967.jpg';
        $activity->save();
        //8.
        $activity= new App\Activity();
        $activity->nombre='boxeo';
        $alergia->ruta_imagen ='Fabiola_actividad_1566079990.jpg';
        $activity->save();
        //9.
        $activity= new App\Activity();
        $activity->nombre='kenpo';
        $alergia->ruta_imagen ='Fabiola_actividad_1566080010.jpg';
        $activity->save();
        //10.
        $activity = new App\Activity();
        $activity->nombre='tennis de mesa';
        $alergia->ruta_imagen ='Fabiola_actividad_1566080032.jpg';
        $activity->save();
        //11.
        $activity = new App\Activity();
        $activity->nombre= 'tennis';
        $alergia->ruta_imagen = 'Fabiola_actividad_1566080063.jpg';
        $activity->save();
        //12
        $activity= new App\Activity();
        $activity->nombre='Otra';
        $alergia->ruta_imagen = 'Fabiola_actividad_1566080083.jpg';
        $activity->save();
    }
}
