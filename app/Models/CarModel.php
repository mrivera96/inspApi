<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'Xplore.dbo.clsModelosVehiculos';
    protected $primaryKey = 'idModeloVehiculo';
    public $timestamps = false;

    public function cars()
    {
        return $this->hasMany(Car::class, 'idModeloVehiculo', 'idModeloVehiculo');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'idMarcaVehiculo', 'idMarcaVehiculo');
    }

    public function rate()
    {
        return $this->belongsTo('App\Models\Rate', 'idTarifa', 'idTarifa');
    }
}
