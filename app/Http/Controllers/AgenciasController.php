<?php

namespace App\Http\Controllers;

use App\Agencias;
use Exception;
use Illuminate\Http\Request;

class AgenciasController extends Controller
{
    public function listarAgencias(){
        try{
            $agencias = Agencias::all();
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
