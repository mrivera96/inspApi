<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $table = 'clsTipoCombustible';
    protected $primaryKey = 'idTipoCombustible';
    public $timestamps = false;

    public function cars(){
        return $this->belongsTo('App\Models\Car', 'idTipoCombustible', 'idTipoCombustible');
    }
}
