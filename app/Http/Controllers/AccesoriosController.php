<?php

namespace App\Http\Controllers;

use App\Accesorios;
use Illuminate\Http\Request;

class AccesoriosController extends Controller
{
    public function listar(){
        try {
            $accesorios = Accesorios::all();
            return response()->json([
                'error' => 0,
                'data' => $accesorios
            ],
                200);
        }catch (\Exception $ex){
            return response()->json([
                'error' => 1,
                'message' => $ex->getMessage()
            ],
                500);
        }

    }
}
