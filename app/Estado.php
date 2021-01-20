<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'clsEstados';
    public $timestamps = false;
    protected $primaryKey = 'idEstado';

    public function inspeccion(){
        return $this->belongsTo('App\Inspeccion', 'idEstado', 'idEstado');
    }
}
