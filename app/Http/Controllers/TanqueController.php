<?php

namespace App\Http\Controllers;

use App\Tanque;
use Illuminate\Http\Request;

class TanqueController extends Controller
{
    public function listarTanques(){
        try {
            $tanques = Tanque::all();
            return response()->json([
                'error' => 0,
                'data' => $tanques],
                200);

        }catch (\Exception $ex){
            return response()->json([
                'error' => 1,
                'data' => $ex->getMessage()],
                500);

        }
    }
}
