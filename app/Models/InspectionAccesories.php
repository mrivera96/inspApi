<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InspectionAccesories extends Model
{
    const CREATED_AT = 'fechaCreacion';
    const UPDATED_AT = 'fechaModificacion';
    protected $table = 'Inspecciones.tblAccesoriosInspeccion';

}
