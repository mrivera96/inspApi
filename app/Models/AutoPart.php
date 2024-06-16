<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AutoPart extends Model
{

    protected $table = 'Inspecciones.clsPiezasVehiculo';
    protected $primaryKey = 'IdPieza';
    protected $casts = [
        'idPieza' => 'integer',
    ];

    public function photos(): BelongsTo
    {
        return $this->belongsTo(InspectionPhoto::class,'idPieza','idPieza');
    }
}
