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
        return $this->belongsToMany('App\Expediente', 'expediente_activity', 'activity_id', 'expediente_id');
    }

    public function lista()
    {
        return $this->belongsTo('App\listaActivity', 'listaId', 'id');
    }

    protected $dates = ['deleted_at'];
}
