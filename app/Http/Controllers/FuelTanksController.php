<?php

namespace App\Http\Controllers;


use App\Models\FuelTank;
use Illuminate\Http\JsonResponse;

class FuelTanksController extends Controller
{
    public function list(): JsonResponse
    {
        try {
            $tanks = FuelTank::all();
            return response()->json([
                    'error' => 0,
                    'data' => $tanks]
            );

        } catch (\Exception $ex) {
            return response()->json([
                'error' => 1,
                'data' => $ex->getMessage()],
                500);

        }
    }
}
