<?php

namespace App\Http\Controllers;

use App\Vehiculo;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;


class VehiculosController extends Controller
{
     public function listVehiculos(){
         try{
             $vehiculos = Vehiculo::all();
             foreach ($vehiculos as $vehiculo){
                 $vehiculo->modelo = $vehiculo->modelo()->get()->first();
                 $vehiculo->modelo->marca = $vehiculo->modelo->marca()->get()->first();
             }

             return response()->json([
                 'error'=> 0,
                 'data' => $vehiculos],
                 200);
         }catch (Exception $ex){
             return response()->json([
                 'error'=> 1,
                 'message' => $ex->getMessage()],
                 500);
         }
    }

    public function searchVehiculo(Request $request){
         $request->validate([
            'busqueda' => 'required'
         ]);
         $busqueda = $request->busqueda;
        try {
            $vehiculos = Vehiculo::where('nemVehiculo','LIKE', "{$busqueda}%")->get(['nemVehiculo','modelo']);
            return response()->json([
                'error'=> 0,
                'data' => $vehiculos],
                200);

        }catch (Exception $ex){
            return response()->json([
                'error'=> 1,
                'message' => $ex->getMessage()],
                500);
        }
    }

    public function getVehiculoData(Request $request){
         $request->validate(['nemVehiculo' => 'required']);
         $nVehiculo = $request->nemVehiculo;
        try{
            $vehiculos = Vehiculo::where('nemVehiculo', $nVehiculo)->get([
                'nemVehiculo',
                'idModeloVehiculo',
                'idTipoCombustible',
                'tipoKilometraje',
                'color',
                'numMatricula'
                ]);
            //return response()->json($vehiculos);
            $vehiculo = (object) [];

            foreach ($vehiculos as $vehi){
                $vehiculo->nemVehiculo = $vehi->nemVehiculo;
                $vehiculo->tipoKilometraje = $vehi->tipoKilometraje;
                $vehiculo->color = $vehi->color;
                $vehiculo->modelo = $vehi->modelo()->get()->first();
                $vehiculo->modelo->marca = $vehi->modelo->marca()->get()->first();
                $vehiculo->combustible = $vehi->combustible()->get()->first();
                $vehiculo->placa = $vehi->numMatricula;
            }
            return response()->json([
                'error'=> 0,
                'data' => $vehiculo],
                200);
        }catch (Exception $ex){
            return response()->json([
                'error'=> 1,
                'message' => $ex->getMessage()],
                500);
        }
    }
}
