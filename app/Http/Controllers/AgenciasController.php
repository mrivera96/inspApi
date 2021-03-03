<?php

namespace App\Http\Controllers;

use App\Agencia;
use Exception;
use Illuminate\Http\Request;

class AgenciasController extends Controller
{
    public function listar(){
        try{
            $agencias = Agencia::where(['idEmpresa' => 1, 'isActivo' => 1])->get();
            return response()->json([
                'error' => 0,
                'data' => $agencias],
                200);
        }catch (Exception $ex){
            return response()->json([
                'error' => 1,
                'data' => $ex->getMessage()],
                500);
        }

    }
}
