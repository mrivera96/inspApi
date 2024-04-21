<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamagePart extends Model
{
    const CREATED_AT = 'fechaCreacion';
    const UPDATED_AT = 'fechaModificacion';
    protected $table = 'Inspecciones.clsPiezasDanio';
    protected $primaryKey = 'IdPieza';
    protected $casts = [
        'idPieza' => 'integer',
    ];

}
