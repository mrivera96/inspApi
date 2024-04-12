<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'tblTarifas';
    protected $primaryKey = 'idTarifa';

    public function models(){
        return $this->hasMany('App\Models\CarModel','idTarifa','idTarifa');
    }
}
