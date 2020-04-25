<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'clsMarcasVehiculos';
    protected $primaryKey = 'idMarcaVehiculo';
    public $timestamps = false;

    public function modelos(){
        return $this->hasMany('App\Modelo', 'idMarcaVehiculo', 'idMarcaVehiculo');
    }
}
