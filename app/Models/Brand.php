<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'Xplore.dbo.clsMarcasVehiculos';
    protected $primaryKey = 'idMarcaVehiculo';
    public $timestamps = false;

    public function models(){
        return $this->hasMany('App\Models\CarModel', 'idMarcaVehiculo', 'idMarcaVehiculo');
    }
}
