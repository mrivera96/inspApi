<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $table = 'clsTipoVehiculo';
    protected $primaryKey = 'idTipoVehiculo';
    protected $casts = [
        'idTipoVehiculo' => 'integer',
    ];
}
