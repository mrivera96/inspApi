<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InspectionAccesories extends Model
{
    protected $table = 'Inspecciones.tblAccesoriosInspeccion';
    const CREATED_AT = 'fechaCreacion';
    const UPDATED_AT = 'fechaModificacion';
}
