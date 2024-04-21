<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends Model
{
    protected $table = 'clsEstados';
    public $timestamps = false;
    protected $primaryKey = 'idEstado';
    protected $casts = [
        'idEstado' => 'integer',
    ];

    public function inspection():BelongsTo{
        return $this->belongsTo('App\Models\Inspection', 'idEstado', 'idEstado');
    }

    public function cars():BelongsTo{
        return $this->belongsTo(Car::class, 'idEstado', 'idEstado');
    }
}
