<?php

namespace App\Http\Controllers;

use App\Models\DamageType;
use Illuminate\Http\JsonResponse;

class DamagesController extends Controller
{

    public function listTypes(): JsonResponse
    {
        try {

            $damageTypes = DamageType::all();
            return response()->json(
                [
                    'error' => 0,
                    'data' => $damageTypes
                ]
            );
        } catch (Exception $ex) {
            return response()->json(
                [
                    'error' => 1,
                    'message' => $ex->getMessage()
                ],
                500
            );
        }
    }
}
