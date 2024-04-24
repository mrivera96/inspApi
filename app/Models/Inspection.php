<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inspection extends Model
{

    protected $table = 'Inspecciones.tblInspecciones';
    protected $primaryKey = 'idInspeccion';
    protected $casts = [
        'idInspeccion' => 'integer',
    ];


    public function car(): HasOne
    {
        return $this->hasOne(Car::class, 'idVehiculo', 'idVehiculo');
    }

    public function checkOutAgency(): HasOne
    {
        return $this->hasOne(Agency::class, 'idAgencia', 'idAgenciaSalida');
    }

    public function state(): HasOne
    {
        return $this->hasOne(State::class, 'idEstado', 'idEstado');
    }

    public function contract(): HasOne
    {
        return $this->hasOne(Contract::class, 'idContrato', 'idContrato');
    }


}
