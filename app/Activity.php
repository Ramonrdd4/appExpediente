<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    protected $fillable = ['nombre'];

    public $table='activities';

    use SoftDeletes;


    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'expediente_activity', 'id', 'expediente_id')->withPivot('minutos', 'cantidad');
    }

    public function lista()
    {
        return $this->belongsTo('App\listaActivity', 'listaId', 'id');
    }

    protected $dates = ['deleted_at'];
}
