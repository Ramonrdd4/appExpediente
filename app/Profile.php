<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['id','nombre', 'primerApellido','segundoApellido','sexo','fechaNacimiento','tipoSangre','direccion','numTelefonico','contactoEmergencia'];

    protected $primaryKey = 'id';
    public $incrementing = false;
    public function user()
    {
        return $this->belongsTo('App\User', 'idUsuario', 'id');
    }

    public function expediente()
    {
        return $this->hasOne('App\Expediente', 'id');
    }

    public function Agenda()
    {
        return $this->hasmany('App\Agenda');
    }
}
