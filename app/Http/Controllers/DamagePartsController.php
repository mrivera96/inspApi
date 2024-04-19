<?php

namespace App\Http\Controllers;

use App\Models\DamagePart;
use Exception;
use Illuminate\Http\JsonResponse;

class DamagePartsController extends Controller
{
    public function list(): JsonResponse
    {
        try {

            $damageTypes = DamagePart::all();
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
