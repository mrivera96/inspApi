<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
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


    public function vehiculo(){
        return $this->hasOne('App\Vehiculo','idVehiculo', 'idVehiculo');
    }

    public function agenciaSalida(){
        return $this->hasOne('App\Agencia', 'idAgencia', 'idAgenciaSalida');
    }


}
