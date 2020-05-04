<?php

namespace App\Http\Controllers;

use App\Tanque;
use App\TipoVehiculo;
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

    public function buscarVehiculo(Request $request){
         $request->validate([
            'busqueda' => 'required'
         ]);
         $busqueda = $request->busqueda;
        try {
            $vehiculos = Vehiculo::where('nemVehiculo','LIKE', "{$busqueda}%")->get(['nemVehiculo','modelo', 'idVehiculo']);
            
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

    public function getDetalleVehiculo(Request $request){
         $request->validate(['nemVehiculo' => 'required']);
         $nVehiculo = $request->nemVehiculo;
        try{
            
            $vehiculos = Vehiculo::where('nemVehiculo', $nVehiculo)->get([
                'nemVehiculo',
                'idModeloVehiculo',
                'idTipoCombustible',
                'tipoKilometraje',
                'color',
                'numMatricula',
                'idVehiculo'
                ]);

            if(InspeccionesController::existeInspeccionByVehiculo($vehiculos->first()->idVehiculo) == 0){
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
            }
    
            return response()->json([
                'error'=> 1,
                'message' => 'Ya hay una inspección abierta para ese vehículo.'],
                200);

            
        }catch (Exception $ex){
            return response()->json([
                'error'=> 1,
                'message' => $ex->getMessage()],
                500);
        }
    }

    public function getTipos(){
         try{
             $tiposVehiculos = TipoVehiculo::all();
             return response()->json([
                 'error'=> 0,
                 'data' => $tiposVehiculos],
                 200);
         }catch (Exception $ex){
             return response()->json([
                 'error'=> 0,
                 'message' => $ex->getMessage()],
                 500);
         }

    }

    public function getTanquesComb(){
        try{
            $tanques = Tanque::all();
            return response()->json([
                'error'=> 0,
                'data' => $tanques],
                200);
        }catch (Exception $ex){
            return response()->json([
                'error'=> 0,
                'message' => $ex->getMessage()],
                500);
        }
    }
}
