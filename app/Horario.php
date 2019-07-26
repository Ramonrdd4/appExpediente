<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public function Agenda()
    {
        return $this->hasMany('App\Agenda');
    }
    public function servicio_consulta()
    {
        return $this->belongsTo('App\Servicio_Consulta','id_servicioConsulta','id');
    }
}
