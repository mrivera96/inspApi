<?php

namespace App\Http\Controllers;

use App\Models\DamageType;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DamageTypesController extends Controller
{

    public function listTypes(): JsonResponse
    {
        try {

            $damageTypes = DamageType::orderBy('orden')->get();
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

    public function createType(Request $request): JsonResponse{
        try {
            $newDamageType = new DamageType();
            $newDamageType->descTipoDanio = $request->descTipoDanio;
            $newDamageType->orden = $request->orden;
            $newDamageType->isActivo = true;
            $newDamageType->usuarioCreacion = Auth::user()->idUsuario;
            $newDamageType->save();

            return response()->json([
                'error' => 0,
                'data' => $newDamageType
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => 1,
                'message' => $ex->getMessage()
            ],
                500);
        }
    }

    public function updateType(Request $request): JsonResponse{
        try {
            $currentDamageType = DamageType::where('idTipoDanio',$request->idTipoDanio)->first();
            $currentDamageType->descTipoDanio = $request->descTipoDanio;
            $currentDamageType->orden = $request->orden;
            $currentDamageType->isActivo = $request->isActivo;
            $currentDamageType->usuarioModificacion = Auth::user()->idUsuario;
            $currentDamageType->update();

            return response()->json([
                'error' => 0,
                'data' => $currentDamageType
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
