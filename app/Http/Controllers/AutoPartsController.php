<?php

namespace App\Http\Controllers;

use App\Models\AutoPart;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AutoPartsController extends Controller
{
    public function list(): JsonResponse
    {
        try {

            $damageTypes = AutoPart::all();
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

    public function create(Request $request): JsonResponse{
        try {
            $newAutoPart = new AutoPart();
            $newAutoPart->descPieza = $request->descPieza;
            $newAutoPart->isActivo = $request->isActivo;
            $newAutoPart->usuarioCreacion = Auth::user()->idUsuario;
            $newAutoPart->save();

            return response()->json([
                'error' => 0,
                'data' => $newAutoPart
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
            $currentAutoPart = AutoPart::where('idPieza',$request->idPieza)->first();
            $currentAutoPart->descPieza = $request->descPieza;
            $currentAutoPart->isActivo = $request->isActivo;
            $currentAutoPart->usuarioModificacion = Auth::user()->idUsuario;
            $currentAutoPart->update();

            return response()->json([
                'error' => 0,
                'data' => $currentAutoPart
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
