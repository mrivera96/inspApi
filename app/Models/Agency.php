<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
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
    ];

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'idAgencia', 'idAgencia');
    }
}
