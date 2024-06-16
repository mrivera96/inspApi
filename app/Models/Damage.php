<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Damage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Damage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Damage query()
 * @mixin \Eloquent
 */
class Damage extends Model
{
    protected $table = 'Inspecciones.tblDaniosInspeccion';
    protected $primaryKey = 'idDanio';
    protected $casts = [
        'idDanio' => 'integer',
        'idInspeccion' => 'integer',
        'idPieza' => 'integer',
        'idTipoDanio' => 'integer',
        'idFoto' => 'integer',
        ];


    public function damageType():HasOne{
        return $this->hasOne(DamageType::class,'idTipoDanio');
    }

    public function damagePart():HasOne{
        return $this->hasOne(AutoPart::class,'idPieza');
    }

    public function photo():HasOne{
        return $this->hasOne(InspectionPhoto::class,'idFoto','idFoto');
    }

    public  function inspections(): BelongsTo
    {
        return $this->belongsTo(Inspection::class,'idInspeccion');
    }
}
