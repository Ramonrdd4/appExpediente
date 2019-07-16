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
        return $this->hasMany('App\Expedientes');
    }

    protected $dates = ['deleted_at'];
}
