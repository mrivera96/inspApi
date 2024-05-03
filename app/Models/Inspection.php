<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
    public function checkInAgency(): HasOne
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

    public function checkoutAccessories(): HasManyThrough
    {
        return $this->hasManyThrough(Accessory::class, InspectionAccesories::class, 'idInspeccion', 'idAccesorio', 'idInspeccion', 'idAccesorio')->where('etapa','checkout');
    }
    public function checkinAccessories(): HasManyThrough
    {
        return $this->hasManyThrough(Accessory::class, InspectionAccesories::class, 'idInspeccion', 'idAccesorio', 'idInspeccion', 'idAccesorio')->where('etapa','checkin');
    }

    public function checkOutAgent(): HasOne
    {
        return $this->hasOne(User::class, 'idUsuario', 'idUsuarioSalida');
    }
    public function checkInAgent(): HasOne
    {
        return $this->hasOne(User::class, 'idUsuario', 'idUsuarioEntrega');
    }

    public function checkoutDamages(): HasMany
    {
        return $this->hasMany(Damage::class, 'idInspeccion', 'idInspeccion')->where('etapa','checkout');
    }
    public function checkinDamages(): HasMany
    {
        return $this->hasMany(Damage::class, 'idInspeccion', 'idInspeccion')->where('etapa','checkin');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(InspectionPhoto::class, 'idInspeccion', 'idInspeccion');
    }
}
