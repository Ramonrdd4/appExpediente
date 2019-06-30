<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'idUsuario', 'correo');
    }

    public function expediente()
    {
        return $this->hasOne('App\Expediente', 'id', 'id');
    }
}