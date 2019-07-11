<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alergia extends Model
{
    use SoftDeletes;
    public function expedientes()
    {
        return $this->hasMany('App\Expediente');
    }
    protected $dates = ['deleted_at'];
}
