<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use App\Models\Accessory;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
    public function list(): JsonResponse
    {
        try {
            $accessories = Accessory::where('isActivo', 1)->orderBy('nomAccesorio')->get(['idAccesorio', 'nomAccesorio']);
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

    public function create(Request $request): JsonResponse{
        try {
            $newAccessory = new Accessory();
            $newAccessory->nomAccesorio = $request->nomAccesorio;
            $newAccessory->isActivo = true;//$request->isActivo;
            $newAccessory->fechaIngreso = Carbon::now();
            $newAccessory->save();

            return response()->json([
                'error' => 0,
                'data' => $newAccessory
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => 1,
                'message' => $ex->getMessage()
            ],
                500);
        }
    }

    public function update(Request $request): JsonResponse{
        try {
            $currentAccessory = Accessory::where('idAccesorio',$request->idAccesorio)->first();
            $currentAccessory->nomAccesorio = $request->nomAccesorio;
            $currentAccessory->isActivo = true;//$request->isActivo;
            $currentAccessory->fechaIngreso = Carbon::now();
            $currentAccessory->update();

            return response()->json([
                'error' => 0,
                'data' => $currentAccessory
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
