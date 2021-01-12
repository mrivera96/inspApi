<?php

namespace App\Http\Controllers;

use App\Inspeccion;
use App\Vehiculo;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Accesorios;


class InspeccionesController extends Controller
{
    public function listarInspecciones(){
        try{
            $inspecciones = Inspeccion::all();
            foreach($inspecciones as $inspeccion){
                $inspeccion->vehiculo;
            }
            return response()->json([
                'error' => 0,
                'data' => $inspecciones],
                200);
        }catch (Exception $ex){
            return response()->json([
                'error' => 1,
                'message' => $ex->getMessage()],
                500);
        }
    }

    public static function existeInspeccionByVehiculo($idVehiculo){
        $existeInspeccion = Inspeccion::where('idVehiculo',$idVehiculo)->where('idEstado', 32)->count();
        return $existeInspeccion;
    }

    public function crearInspeccion(Request $request){
        $accesorios = $request -> accesorios;
        $dGenerales = $request -> datosGenerales;
        $dSalida = $request -> datosSalida;
        $firma = $request -> firma;

        $nInspeccion = new Inspeccion();
        $id = Vehiculo::where('nemVehiculo', $dGenerales['nVehiculo'])->get('idVehiculo')->first();
        $nInspeccion -> idVehiculo = $id->idVehiculo;
        $nInspeccion -> idAgenciaSalida = $dSalida['idAgenciaSalida'];
        $nInspeccion -> combSalida = $dSalida['combSalida'];
        $nInspeccion -> rendCombSalida = $dSalida['rendCombSalida'];
        $nInspeccion -> odoSalida = $dSalida['odoSalida'];
        $date = date('Y-m-d', strtotime($dSalida['fechaSalida']));
        $time = $dSalida['horaSalida'];
        $datetime = $date.' '.$time;
        $nInspeccion -> fechaSalida = new Carbon($datetime);
        $nInspeccion -> idUsuarioSalida = Auth::user()->idUsuario;

        if($firma['firmaClienteSalida']){
            $image = str_replace('data:image/png;base64,', '', $firma['firmaClienteSalida']);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(15).time().'.png';
            \File::put(public_path(). '/img/firmas/' . $imageName, base64_decode($image));
            $nInspeccion -> firmaClienteSalida =  '/img/firmas/'.$imageName;
        }
        
        
        $nInspeccion -> nomRecibeVehiculo = $firma['nomRecibeVehiculo'];
        $nInspeccion -> idEstado = 32;
        $nInspeccion -> fechaProceso = Carbon::now('America/Tegucigalpa');
        
        $nInspeccion->save();
        AccesoriosInspeccionController::insertarAccesorio($accesorios, $nInspeccion->idInspeccion);
   
        return response()->json([
            'error' => 0,
            'data' => $nInspeccion->idInspeccion
        ],200);
    }

    public function getInspeccionById(Request $request){
        try{
            $inspeccion = Inspeccion::where('idInspeccion', $request->idInspeccion)->get()->first();
             $inspeccion->vehiculo;
             $inspeccion->vehiculo->modelo = $inspeccion->vehiculo->modelo()->get()->first();
             $inspeccion->vehiculo->marca = $inspeccion->vehiculo->modelo->marca()->get()->first();
             $inspeccion->agenciaSalida;
            return response()->json([
                'error' => 0,
                'data' => $inspeccion],
                200);
        }catch (Exception $ex){
            return response()->json([
                'error' => 1,
                'message' => $ex->getMessage()],
                500);
        }
    }

    public function cerrarInspeccion(Request $request){
        
    }
}
