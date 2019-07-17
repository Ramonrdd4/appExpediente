<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listaDesease extends Model
{
    public function deseases()
    {
        return $this->hasMany('App\Desease');
    }
}
