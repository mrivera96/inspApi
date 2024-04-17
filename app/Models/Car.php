<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Car extends Model
{
    protected $table = 'Xplore.dbo.tblVehiculos';
    protected $primaryKey = 'idVehiculo';
    public $timestamps = false;

    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'idModeloVehiculo', 'idModeloVehiculo');
    }

    public function fuel(): HasOne
    {
        return $this->hasOne(Fuel::class, 'idTipoCombustible', 'idTipoCombustible');
    }

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class, 'idVehiculo', 'idVehiculo');
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'idVehiculo', 'idVehiculo');
    }

}