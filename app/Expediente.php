<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    public function profile()
    {
        return $this->belongsTo('App\Profile', 'id', 'id');
    }

    public function fumado()
    {
        return $this->hasOne('App\Fumado', 'id', 'id');
    }

    public function alcohol()
    {
        return $this->hasOne('App\Alcohol', 'id', 'id');
    }

    public function cirugias()
    {
        return $this->hasMany('App\Cirugia');
    }

    public function alergias()
    {
        return $this->hasMany('App\Alergias');
    }

    public function medicamentos()
    {
        return $this->hasMany('App\Medicamento');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function deseases()
    {
        return $this->hasMany('App\Desease');
    }
}
