<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = 'clsModelosVehiculos';
    protected $primaryKey = 'idModeloVehiculo';
    public $timestamps = false;

    public function vehiculos(){
        return $this->hasMany('App\Vehiculo', 'idModeloVehiculo', 'idModeloVehiculo');
    }

    public function marca(){
        return $this->belongsTo('App\Marca', 'idMarcaVehiculo', 'idMarcaVehiculo');
    }
}
