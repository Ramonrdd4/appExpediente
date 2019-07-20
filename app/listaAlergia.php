<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listaAlergia extends Model
{
    public function alergias()
    {
        return $this->hasMany('App\Alergia', 'listaId', 'id');
    }

    
}
