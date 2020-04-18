<?php

namespace App\Http\Controllers;

use App\Vehiculos;
use Exception;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{
     public function listarVehiculos(){
         try{
             $vehiculos = Vehiculos::all();
             return response()->json([
                 'error'=> 0,
                 'data' => $vehiculos],
                 200);
         }catch (Exception $ex){
             return response()->json([
                 'error'=> 1,
                 'data' => $ex->getMessage()],
                 500);
         }
    }
}
