<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $table = 'Inspecciones.tblInspecciones';
    protected $primaryKey = 'idInspeccion';
    const CREATED_AT = 'fechaCreacion';
    const UPDATED_AT = 'fechaModificacion';

    public function car(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\Car','idVehiculo', 'idVehiculo');
    }

    public function checkOutAgency(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\Agency', 'idAgencia', 'idAgenciaSalida');
    }

    public function state(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\State', 'idEstado', 'idEstado');
    }


}
