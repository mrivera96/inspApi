<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FuelTank extends Model
{
    protected $table = 'clsTanqueComb';
    public $timestamps = false;
    protected $primaryKey = 'idTanqueComb';
    protected $casts = [
        'idTanqueComb' => 'integer',
    ];

    public function checkinContracts(): BelongsTo
    {
        return $this->belongsTo(Contract::class,'idTanqueComb','idTanqueEnt');
    }
    public function checkoutContracts(): BelongsTo
    {
        return $this->belongsTo(Contract::class,'idTanqueComb','idTanqueSal');
    }

}
