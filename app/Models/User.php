<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use  HasApiTokens, Notifiable;

    protected $table = 'tblUsuarios';
    protected $primaryKey = 'idUsuario';
    public $timestamps = false;

    protected $fillable = [
        'idPerfil',
        'nomUsuario',
        'nickUsuario',
        'passUsuario',
        'isActivo',
        'lastLogin',
        'fechaCreacion',
        'idAgencia',
        'passcodeUsuario'
    ];

    protected $hidden =[
        'passUsuario',
        'passcodeUsuario'
    ];

    public function getAuthPassword()
    {
        return $this->passUsuario;
    }




}
