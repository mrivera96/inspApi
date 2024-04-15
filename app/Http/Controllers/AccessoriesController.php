<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use App\Models\Accessory;

class AccessoriesController extends Controller
{
    public function list(): JsonResponse
    {
        try {
            $accessories = Accessory::all();
            return response()->json([
                'error' => 0,
                'data' => $accessories
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => 1,
                'message' => $ex->getMessage()
            ],
                500);
        }

    }
}
