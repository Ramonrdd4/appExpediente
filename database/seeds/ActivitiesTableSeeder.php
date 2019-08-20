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
        $activity->ruta_imagen ='Fabiola_actividad_1566079807.jpg';
        $activity->save();
        //2.
        $activity= new App\Activity();
        $activity->nombre='Natación';
        $activity->ruta_imagen ='Fabiola_actividad_1566079832.jpeg';
        $activity->save();
        //3.
        $activity= new App\Activity();
        $activity->nombre='Basketball';
        $activity->ruta_imagen ='Fabiola_actividad_1566079858.jpg';
        $activity->save();
        //4.
        $activity= new App\Activity();
        $activity->nombre='Soccer';
        $activity->ruta_imagen ='Fabiola_actividad_1566079886.jpg';
        $activity->save();
        //5.
        $activity= new App\Activity();
        $activity->nombre='Ciclismo';
        $activity->ruta_imagen ='Fabiola_actividad_1566079917.jpg';
        $activity->save();
        //6.
        $activity= new App\Activity();
        $activity->nombre='Triatlon';
        $activity->ruta_imagen ='Fabiola_actividad_1566079947.jpg';
        $activity->save();
        //7.
        $activity= new App\Activity();
        $activity->nombre='yoga';
        $activity->ruta_imagen ='Fabiola_actividad_1566079967.jpg';
        $activity->save();
        //8.
        $activity= new App\Activity();
        $activity->nombre='boxeo';
        $activity->ruta_imagen ='Fabiola_actividad_1566079990.jpg';
        $activity->save();
        //9.
        $activity= new App\Activity();
        $activity->nombre='kenpo';
        $activity->ruta_imagen ='Fabiola_actividad_1566080010.jpg';
        $activity->save();
        //10.
        $activity = new App\Activity();
        $activity->nombre='tennis de mesa';
        $activity->ruta_imagen ='Fabiola_actividad_1566080032.jpg';
        $activity->save();
        //11.
        $activity = new App\Activity();
        $activity->nombre= 'tennis';
        $activity->ruta_imagen = 'Fabiola_actividad_1566080063.jpg';
        $activity->save();
        //12
        $activity= new App\Activity();
        $activity->nombre='Otra';
        $activity->ruta_imagen = 'Fabiola_actividad_1566080083.jpg';
        $activity->save();
    }
}
