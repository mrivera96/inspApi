<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];

    public function damageType(){
        return $this->hasOne(DamageType::class,'idTipoDanio');
    }

    public function damagePart(){
        return $this->hasOne(AutoPart::class,'idPieza');
    }
}
