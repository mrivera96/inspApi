<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccesoriosInspeccion;
use App\Models\Accesory;
class InspectionAccesoriesController extends Controller
{
    public static function insertarAccesorio($accesorios, $inspId){
        foreach($accesorios as $accesorio => $value) {
            if($value != 0){
                $idAccesorio = Accesory::where('nomAccesorio', $accesorio)->get('idAccesorio')->first()->idAccesorio;
                $existeAccesorio = AccesoriosInspeccion::where('IdInspeccion', $inspId)->where('IdAccesorio', $idAccesorio)->count();
                if($existeAccesorio == 0 ){
                    $nAccesorioInsp = new AccesoriosInspeccion();
                    $nAccesorioInsp->IdInspeccion = $inspId;
                    $nAccesorioInsp->IdAccesorio = $idAccesorio;
                    $nAccesorioInsp->tipo = 'SA';
                    $nAccesorioInsp->cantidad = $value;

                    $nAccesorioInsp->save();
                }

            }
        }

    }
}
