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
        return $this->belongsToMany('App\Alergia', 'expediente_alergia', 'expediente_id', 'alergia_id')->withTimestamps();
    }

    public function medicamentos()
    {
        return $this->belongsToMany('App\Medicamento', 'medicamento_expediente', 'expediente_id', 'medicamento_id')->withTimestamps();
    }

    public function activities()
    {
        return $this->belongsToMany('App\Activity', 'expediente_activity', 'expediente_id', 'activity_id')->withTimestamps();
    }

    public function deseases()
    {
        return $this->belongsToMany('App\Desease', 'expediente_desease', 'expediente_id', 'desease_id')->withTimestamps();
    }
    public function parentezco()
    {
        return $this->hasMany('App\Parentezco');
    }
}
