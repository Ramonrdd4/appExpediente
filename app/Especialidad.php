<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    public $table='especialidades';

    public function servicio__consultas()
    {
        return $this->hasmany('App\servicio__consultas','id','id_Especialidad');
    }
}
