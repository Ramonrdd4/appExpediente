<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alergia extends Model
{
    protected $fillable = ['nombre', 'categoria','reaccion','observaciones'];
    use SoftDeletes;
    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'expediente_alergia', 'alergia_id', 'expediente_id');
    }

    public function lista()
    {
        return $this->belongsTo('App\listaAlergia', 'listaId', 'id');
    }
    protected $dates = ['deleted_at'];
}
