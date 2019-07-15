<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{


    public function expedientes()
    {
        return $this->hasMany('App\Expedientes');
    }
   

}
