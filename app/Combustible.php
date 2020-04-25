<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combustible extends Model
{
    protected $table = 'clsTipoCombustible';
    protected $primaryKey = 'idTipoCombustible';
    public $timestamps = false;

    public function vehiculos(){
        return $this->belongsTo('App\Vehiculo', 'idTipoCombustible', 'idTipoCombustible');
    }
}
