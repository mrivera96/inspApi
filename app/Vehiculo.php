<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'tblVehiculos';
    protected $primaryKey = 'idVehiculo';
    public $timestamps = false;

    public function modelo(){
        return $this->belongsTo('App\Modelo', 'idModeloVehiculo', 'idModeloVehiculo');
    }

    public function combustible(){
        return $this->hasOne('App\Combustible', 'idTipoCombustible', 'idTipoCombustible');
    }

}
