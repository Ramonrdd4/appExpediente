<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio_Consulta extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function especialidad()
    {
        return $this->belongsTo('App\Especialidad');
    }
    public function horarios()
    {
        return $this->hasMany('App\Horario');
    }
}
