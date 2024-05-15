<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Accessory extends Model
{
    public mixed $nomAccesorio;
    public mixed $isActivo;
    public mixed $fechaIngreso;
    protected $table = 'clsAccesorios';
    public $timestamps = false;
    protected $primaryKey = 'idAccesorio';
    protected $casts = [
        'idAccesorio' => 'integer',
    ];
}
