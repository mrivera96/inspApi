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
    const CREATED_AT = 'fechaCreacion';
    const UPDATED_AT = 'fechaModificacion';
    protected $table = 'Inspecciones.tblDaniosInspeccion';
    protected $primaryKey = 'idDanio';

}
