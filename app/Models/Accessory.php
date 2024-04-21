<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Accessory extends Model
{
    protected $table = 'clsAccesorios';
    public $timestamps = false;
    protected $primaryKey = 'idAccesorio';
    protected $casts = [
        'idAccesorio' => 'integer',
    ];
}
