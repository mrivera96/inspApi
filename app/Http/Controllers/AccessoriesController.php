<?php

namespace App\Http\Controllers;

use App\Models\Accesory;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
    public function list(){
        try {
            $accesorios = Accesory::all();
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
