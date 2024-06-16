<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AgenciesController extends Controller
{
    public function list(): JsonResponse
    {
        try {
            $agencies = Agency::where(['idEmpresa' => 1, 'isActivo' => 1])->get();
            return response()->json([
                'error' => 0,
                'data' => $agencies]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => 1,
                'data' => $ex->getMessage()],
                500);
        }

    }
}
