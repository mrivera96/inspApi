<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contract extends Model
{
    protected $table = 'tblContratos';
    protected $primaryKey = 'idContrato';

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'idVehiculo', 'idVehiculo');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'idCliente', 'idCliente');
    }

    public function state(): HasOne
    {
        return $this->hasOne(State::class, 'idEstado', 'idEstado');
    }

    public function checkOutAgency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'idAgencia', 'idAgenciaSalida');
    }

    public function checkInAgency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'idAgencia', 'idAgenciaEntrega');
    }

    public function checkOutFuelTank(): HasOne
    {
        return $this->hasOne(FuelTank::class, 'idTanque', 'idTanqueSal');
    }

    public function checkInFuelTank(): HasOne
    {
        return $this->hasOne(FuelTank::class, 'idTanque', 'idTanqueEnt');
    }
}
