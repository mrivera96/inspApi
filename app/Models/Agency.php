<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'clsAgencias';
    public $timestamps = false;
    protected $primaryKey = 'idAgencia';
    protected $hidden = ['datosRentaWeb'];
}
