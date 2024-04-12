<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $table = 'tblInspecciones';
    public $timestamps = false;
    protected $primaryKey = 'idInspeccion';

    protected $fillable = [
        'idInspeccion',
        'numContrato',
        'idCliente',
        'idVehiculo',
        'idAgenciaSalida',
        'combSalida',
        'rendCombSalida',
        'odoSalida',
        'fechaSalida',
        'idUsuarioSalida',
        'firmaClienteSalida',
        'idAgenciaEntrega',
        'combEntrega',
        'rendCombEntrega',
        'odoEntrega',
        'fechaEntrega',
        'idUsuarioEntrega',
        'firmaClienteEntrega',
        'nomRecibeVehiculo',
        'nomEntregaVehiculo',
        'idEstado',
        'fechaProceso'
    ];


    public function car(){
        return $this->hasOne('App\Models\Car','idVehiculo', 'idVehiculo');
    }

    public function checkOutAgency(){
        return $this->hasOne('App\Models\Agency', 'idAgencia', 'idAgenciaSalida');
    }

    public function state(){
        return $this->hasOne('App\Models\State', 'idEstado', 'idEstado');
    }


}
