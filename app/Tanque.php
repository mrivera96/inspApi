<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tanque extends Model
{
    protected $table = 'clsTanqueComb';
    public $timestamps = false;
    protected $primaryKey = 'idTanqueComb';
}
