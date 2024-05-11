<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InspectionPhoto extends Model
{
    use HasFactory;


    protected $table = 'Inspecciones.tblFotosInspeccion';
    protected $primaryKey = 'idFoto';
    protected $casts = [
        'idPieza' => 'integer',
        'idFoto' => 'integer',
        'idInspeccion' => 'integer',
    ];

    public function autoPart(): HasOne
    {
        return $this->hasOne(AutoPart::class, 'idPieza', 'idPieza');
    }


    public function damages(): BelongsTo
    {
        return $this->belongsTo(Damage::class, 'idFoto','idFoto');
    }
}

