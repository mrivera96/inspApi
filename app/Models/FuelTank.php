<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FuelTank extends Model
{
    protected $table = 'clsTanqueComb';
    public $timestamps = false;
    protected $primaryKey = 'idTanqueComb';
}
