<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DamageType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DamageType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DamageType query()
 * @mixin \Eloquent
 */
class DamageType extends Model
{

    protected $table = 'Inspecciones.clsTiposDanio';
    protected $primaryKey = 'idTipoDanio';
    protected $casts = [
        'idTipoDanio' => 'integer',
    ];

}
