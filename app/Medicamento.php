<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicamento extends Model
{
    protected $fillable = ['nombre', 'descripcion'];
    use SoftDeletes;

    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'medicamento_expediente', 'medicamento_id', 'expediente_id');
    }

    protected $dates = ['deleted_at'];
}
