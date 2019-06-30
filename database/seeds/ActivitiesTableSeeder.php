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
        $activity= new App\Activity;
        $activity->nombre='Correr';
        $activity->save();
        //2.
        $activity= new App\Activity;
        $activity->nombre='Natación';
        $activity->save();
        //3.
        $activity= new App\Activity;
        $activity->nombre='Basketball';
        $activity->save();
        //4.
        $activity= new App\Activity;
        $activity->nombre='Soccer';
        $activity->save();
        //5.
        $activity= new App\Activity;
        $activity->nombre='Ciclismo';
        $activity->save();
        //6.
        $activity= new App\Activity;
        $activity->nombre='Triatlon';
        $activity->save();
        //7.
        $activity= new App\Activity;
        $activity->nombre='yoga';
        $activity->save();
        //8.
        $activity= new App\Activity;
        $activity->nombre='boxeo';
        $activity->save();
        //9.
        $activity= new App\Activity;
        $activity->nombre='kenpo';
        $activity->save();
    }
}
