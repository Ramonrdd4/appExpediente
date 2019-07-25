<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $fillable = ['idperfil'];



    public function profile()
    {
        return $this->belongsTo('App\Profile','idperfil','id');
    }

    public function fumado()
    {
        return $this->belongsTo('App\Fumado','idperfil','id');
    }

    public function alcohol()
    {
        return $this->belongsTo('App\Alcohol','idperfil','id');
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

}
