<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicio__consultas extends Model
{

     public $table='servicio__consultas';

     protected $fillable = [
        'precio','ubicacion', 'id_Doctor','id_Especialidad'];

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
         return $this->belongsTo('App\Horario','id','id_servicioConsulta');
     }
}
