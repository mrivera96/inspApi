<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\InspectionAccesories;
use Illuminate\Http\Request;

class InspectionAccessoriesController extends Controller
{
    public static function add($accessories, $inspId): void
    {
        foreach ($accessories as $accessory => $value) {
            if ($value != 0) {
                $idAccesorio = Accessory::where('nomAccesorio', $accessory)->get('idAccesorio')->first()->idAccesorio;
                $existeAccesorio = InspectionAccesories::where('IdInspeccion', $inspId)->where('IdAccesorio', $idAccesorio)->count();
                if ($existeAccesorio == 0) {
                    $nAccesorioInsp = new InspectionAccesories();
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
