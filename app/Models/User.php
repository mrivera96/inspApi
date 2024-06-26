<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use  HasApiTokens, Notifiable;

    protected $table = 'tblUsuarios';
    protected $primaryKey = 'idUsuario';
    public $timestamps = false;
    protected $casts = [
        'idUsuario' => 'integer',
        'idPerfil' => 'integer',
    ];

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

    public function contracts(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'idUsuario', 'idConductor');
    }

    public function additionalContracts(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'idUsuario', 'idConductorAdic');
    }


}
