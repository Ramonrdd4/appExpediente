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
        $activity->listaId=1;
        $activity->save();
        //2.
        $activity= new App\Activity();
        $activity->nombre='Natación';
        $activity->listaId=1;
        $activity->save();
        //3.
        $activity= new App\Activity();
        $activity->nombre='Basketball';
        $activity->listaId=1;
        $activity->save();
        //4.
        $activity= new App\Activity();
        $activity->nombre='Soccer';
        $activity->listaId=1;
        $activity->save();
        //5.
        $activity= new App\Activity();
        $activity->nombre='Ciclismo';
        $activity->listaId=1;
        $activity->save();
        //6.
        $activity= new App\Activity();
        $activity->nombre='Triatlon';
        $activity->listaId=1;
        $activity->save();
        //7.
        $activity= new App\Activity();
        $activity->nombre='yoga';
        $activity->listaId=1;
        $activity->save();
        //8.
        $activity= new App\Activity();
        $activity->nombre='boxeo';
        $activity->listaId=1;
        $activity->save();
        //9.
        $activity= new App\Activity();
        $activity->nombre='kenpo';
        $activity->listaId=1;
        $activity->save();
        //10.
        $activity = new App\Activity();
        $activity->nombre='tennis de mesa';
        $activity->listaId=1;
        $activity->save();
        //11.
        $activity = new App\Activity();
        $activity->nombre= 'tennis';
        $activity->save();
    }
}
