<?php

namespace App\Http\Controllers;

use App\Inspeccion;
use Exception;
use Illuminate\Http\Request;

class InspeccionesController extends Controller
{
    public function listarInspecciones(){
        try{
            $inspecciones = Inspeccion::all();
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
}
