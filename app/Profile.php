<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['id','nombre', 'primerApellido','segundoApellido','sexo','fechaNacimiento','tipoSangre','direccion','numTelefonico','contactoEmergencia'];

    protected $primaryKey = 'id';
    public function user()
    {
        return $this->belongsTo('App\User', 'idUsuario', 'id');
    }

    public function expediente()
    {
        return $this->belongsTo('App\Expediente','id','idperfil');
    }
    public function Agenda()
    {
        return $this->hasmany('App\Agenda');
    }
}
