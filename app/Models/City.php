<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $table = 'tblCiudades';
    public $timestamps = false;
    protected $primaryKey = 'idCiudad';
    protected $casts = [
        'idCiudad' => 'integer',
    ];


    public function agencies(): HasMany
    {
        return $this->hasMany(Agency::class, 'idCiudad','idCiudad');
    }
}
