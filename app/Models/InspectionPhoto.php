<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionPhoto extends Model
{
    use HasFactory;

    protected $table = 'Inspecciones.tblFotosInspeccion';

    public function autoPart(){
        return $this->hasOne(AutoPart::class,'idPieza');
    }
}
