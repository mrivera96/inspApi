<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $table = 'tblClientes';
    protected $primaryKey = 'idCliente';
    protected $casts = [
        'idCliente' => 'integer',
    ];
    public function contracts(): HasMany{
        return $this->hasMany(Contract::class, 'idCliente', 'idCliente');
    }

    public function driverContracts(): BelongsTo{
        return $this->belongsTo(Contract::class, 'idConductor', 'idCliente');
    }

    public function additionalDriverContracts(): BelongsTo{
        return $this->belongsTo(Contract::class, 'idConductorAdic', 'idCliente');
    }
}
