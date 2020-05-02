<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agencia extends Model
{
    protected $table = 'clsAgencias';
    public $timestamps = false;
    protected $primaryKey = 'idAgencia';
    protected $hidden = ['datosRentaWeb'];
}
