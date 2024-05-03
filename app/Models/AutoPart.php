<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoPart extends Model
{

    protected $table = 'Inspecciones.clsPiezasVehiculo';
    protected $primaryKey = 'IdPieza';
    protected $casts = [
        'idPieza' => 'integer',
    ];

}
