<?php

namespace App\Http\Controllers;

use App\Models\Agencia;
use Exception;
use Illuminate\Http\Request;

class AgenciesController extends Controller
{
    public function list(){
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
