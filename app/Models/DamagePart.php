<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamagePart extends Model
{

    protected $table = 'Inspecciones.clsPiezasDanio';
    protected $primaryKey = 'IdPieza';
    protected $casts = [
        'idPieza' => 'integer',
    ];

}
