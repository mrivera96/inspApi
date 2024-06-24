<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    protected $fillable = ['numInspeccion', 'idAgenciaSalida'];


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
        return $this->hasManyThrough(Accessory::class, InspectionAccesories::class, 'idInspeccion', 'idAccesorio', 'idInspeccion', 'idAccesorio')->where('etapa', 'checkout');
    }

    public function checkinAccessories(): HasManyThrough
    {
        return $this->hasManyThrough(Accessory::class, InspectionAccesories::class, 'idInspeccion', 'idAccesorio', 'idInspeccion', 'idAccesorio')->where('etapa', 'checkin');
    }

    public function checkOutAgent(): HasOne
    {
        return $this->hasOne(User::class, 'idUsuario', 'idUsuarioSalida');
    }

    public function checkInAgent(): HasOne
    {
        return $this->hasOne(User::class, 'idUsuario', 'idUsuarioEntrega');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(InspectionPhoto::class, 'idInspeccion', 'idInspeccion');
    }

    public function checkOutFuel(): HasOne
    {
        return $this->hasOne(FuelTank::class, 'idTanqueComb', 'combSalida');
    }

    public function checkInFuel(): HasOne
    {
        return $this->hasOne(FuelTank::class, 'idTanqueComb', 'combEntrega');
    }

    public function damages(): HasMany
    {
        return $this->hasMany(Damage::class, 'idInspeccion', 'idInspeccion');
    }


    protected static function boot()
    {
        parent::boot();

        // Handle the "creating" event to generate the identifier
        static::creating(function ($inspection) {
            $newInspectionCity = Agency::where('idAgencia', $inspection->idAgenciaSalida)->first()->idCiudad;
            $agenciesIds = Agency::where('idCiudad', $newInspectionCity)->get()->select('idAgencia')->toArray();
            // Get the last inspection conducted in the same city
            $lastInspection = static::whereIn('idAgenciaSalida', $agenciesIds)
                ->orderBy('idInspeccion', 'desc')
                ->get()
                ->first();


            //get preffix
            $codCiudad = $newInspectionCity;
            switch ($codCiudad) {
                case 1:
                    $preffix = 'TGU';
                    break;

                case 2:
                    $preffix = 'SPS';
                    break;
                case 3:
                    $preffix = 'CHL';
                    break;
                case 6:
                    $preffix = 'COM';
                    break;
            }


            // Generate the new identifier
            if ($lastInspection) {
                $lastIdParts = explode('-', $lastInspection->numInspeccion);
                $number = intval($lastIdParts[1] . $lastIdParts[2]) + 1;
            } else {
                $number = 1;
            }


            $inspection->numInspeccion = $preffix . '-' . substr_replace(str_pad($number, 6, '0', STR_PAD_LEFT), '-', 2, 0);
        });
    }
}
