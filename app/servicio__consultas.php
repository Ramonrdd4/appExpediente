<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicio__consultas extends Model
{
     //
    public function user()
     {
         return $this->belongsTo('App\User','id_Doctor','id');
     }
     public function especialidad()
     {
         return $this->belongsTo('App\Especialidad','id_Especialidad','id');
     }
     public function horarios()
     {
         return $this->hasMany('App\Horario','id','id_servicioConsulta');
     }
}
