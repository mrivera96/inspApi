<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'clsModelosVehiculos';
    protected $primaryKey = 'idModeloVehiculo';
    public $timestamps = false;

    public function cars(){
        return $this->hasMany('App\Models\Car', 'idModeloVehiculo', 'idModeloVehiculo');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'idMarcaVehiculo', 'idMarcaVehiculo');
    }

    public function fee(){
        return $this->belongsTo('App\Models\Fee','idTarifa','idTarifa');
    }
}
