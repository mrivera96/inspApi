<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $table = 'tblTarifas';
    protected $primaryKey = 'idTarifa';

    public function modelos(){
        return $this->hasMany('App\Modelo','idTarifa','idTarifa');
    }
}
