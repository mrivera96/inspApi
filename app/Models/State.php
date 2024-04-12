<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'clsEstados';
    public $timestamps = false;
    protected $primaryKey = 'idEstado';

    public function inspection(){
        return $this->belongsTo('App\Models\Inspection', 'idEstado', 'idEstado');
    }
}
