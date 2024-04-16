<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $table = 'tblClientes';
    protected $primaryKey = 'idCliente';

    public function contracts(): HasMany{
        return $this->hasMany(Contract::class, 'idCliente', 'idCliente');
    }
}
