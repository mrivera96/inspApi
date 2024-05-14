<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agency extends Model
{
    protected $table = 'clsAgencias';
    public $timestamps = false;
    protected $primaryKey = 'idAgencia';
    protected $hidden = ['datosRentaWeb'];
    protected $casts = [
        'idAgencia' => 'integer',
        'idCiudad' => 'integer',
    ];

    public function checkoutContracts(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'idAgencia', 'idAgenciaSalida');
    }

    public function checkinContracts(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'idAgencia', 'idAgenciaEntrega');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'idCiudad', 'idCiudad');
    }
}
