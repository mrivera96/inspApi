<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'tblTarifas';
    protected $primaryKey = 'idTarifa';
    protected $casts = [
        'idTarifa' => 'integer',
    ];

    public function models(){
        return $this->hasMany('App\Models\CarModel','idTarifa','idTarifa');
    }
}
