<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contract extends Model
{
    protected $table = 'tblContratos';
    protected $primaryKey = 'idContrato';
    protected $casts = [
        'idContrato' => 'integer',
        'idVehiculo' => 'integer',
        'idCliente' => 'integer',
        'idAgenciaSalida' => 'integer',
        'idAgenciaEntrega' => 'integer',
        'idEstado'=> 'integer'

    ];

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

    public function checkOutAgency(): HasOne
    {
        return $this->hasOne(Agency::class,'idAgencia','idAgenciaSalida');
    }

    public function checkInAgency(): HasOne
    {
        return $this->hasOne(Agency::class,'idAgencia', 'idAgenciaEntrega');
    }

    public function checkOutFuelTank(): HasOne
    {
        return $this->hasOne(FuelTank::class, 'idTanque', 'idTanqueSal');
    }

    public function checkInFuelTank(): HasOne
    {
        return $this->hasOne(FuelTank::class, 'idTanque', 'idTanqueEnt');
    }

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class, 'idContrato', 'idContrato');
    }

    public function checkOutFuel(): HasOne
    {
        return $this->hasOne(FuelTank::class, 'idTanqueComb', 'idTanqueSal');
    }
    public function checkInFuel(): HasOne
    {
        return $this->hasOne(FuelTank::class, 'idTanqueComb', 'idTanqueEnt');
    }

    public function driver(): HasOne
    {
        return $this->hasOne(User::class, 'idUsuario', 'idConductor');
    }

    public function additionalDriver(): HasOne
    {
        return $this->hasOne(User::class, 'idUsuario', 'idConductorAdic');
    }
}
