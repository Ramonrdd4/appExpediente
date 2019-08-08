<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = ['Fecha_cita','hora_cita'];
    public function Agenda()
    {
        return $this->hasMany('App\Agenda');
    }
    public function servicio__consultas()
    {
        return $this->belongsTo('App\servicio__consultas','id_servicioConsulta','id');
    }
}
