<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Desease extends Model
{
    protected $fillable = ['nombre', 'observaciones'];
    use SoftDeletes;

    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'expediente_desease', 'desease_id', 'expediente_id');
    }

    public function lista()
    {
        return $this->belongsTo('App\listaDesease', 'listaId', 'id');
    }

    protected $dates = ['deleted_at'];
}
