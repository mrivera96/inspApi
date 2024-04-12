<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'tblVehiculos';
    protected $primaryKey = 'idVehiculo';
    public $timestamps = false;

    public function model(){
        return $this->belongsTo('App\Models\CarModel', 'idModeloVehiculo', 'idModeloVehiculo');
    }

    public function fuel(){
        return $this->hasOne('App\Models\Fuel', 'idTipoCombustible', 'idTipoCombustible');
    }

    public function inspection(){
        return $this->belongsTo('App\Models\Inspection', 'idVehiculo', 'idVehiculo');
    }

}
