<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inspection extends Model
{
    protected $table = 'Inspecciones.tblInspecciones';
    protected $primaryKey = 'idInspeccion';
    const CREATED_AT = 'fechaCreacion';
    const UPDATED_AT = 'fechaModificacion';

    public function car(): HasOne
    {
        return $this->hasOne('App\Models\Car', 'idVehiculo', 'idVehiculo');
    }

    public function checkOutAgency(): HasOne
    {
        return $this->hasOne('App\Models\Agency', 'idAgencia', 'idAgenciaSalida');
    }

    public function state(): HasOne
    {
        return $this->hasOne('App\Models\State', 'idEstado', 'idEstado');
    }


}
