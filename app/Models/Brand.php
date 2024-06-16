<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'Xplore.dbo.clsMarcasVehiculos';
    protected $primaryKey = 'idMarcaVehiculo';
    public $timestamps = false;
    protected $casts = [
        'idMarcaVehiculo' => 'integer',
    ];

    public function models(){
        return $this->hasMany(CarModel::class, 'idMarcaVehiculo', 'idMarcaVehiculo');
    }
}
