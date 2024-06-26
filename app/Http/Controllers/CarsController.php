<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Contract;
use App\Models\Rate;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class CarsController extends Controller
{
    public function list(): JsonResponse
    {
        try {

            $contracts = Car::with(
                [
                    'model:idModeloVehiculo,idMarcaVehiculo', 'model.brand:idMarcaVehiculo,descMarca'
                ]
            )->whereIn('idEstado', [3,5])->select('idVehiculo','nemVehiculo','numMatricula','idModeloVehiculo','modelo','nemVehiculo','odometro','color')->get();

            return response()->json(
                [
                    'error' => 0,
                    'data' => $contracts
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

    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'busqueda' => 'required'
        ]);
        $term = $request->busqueda;
        try {
            $cars = Car::where('nemVehiculo', 'LIKE', "$term%")->get(['nemVehiculo', 'modelo', 'idVehiculo']);

            return response()->json([
                'error' => 0,
                'data' => $cars
            ]);
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

    public function getDetails(Request $request): JsonResponse
    {
        $request->validate(['nemVehiculo' => 'required']);
        $nVehiculo = $request->nemVehiculo;
        try {

            $car = Car::with(['model.brand', 'model.rate', 'fuel'])->where('nemVehiculo', $nVehiculo)->get([
                'nemVehiculo',
                'tipoKilometraje',
                'color',
                'numMatricula'
            ]);

            if (InspectionsController::inspectionByCar($car->first()->idVehiculo) == 0) {
                //$car = (object)[];

                return response()->json([
                    'error' => 0,
                    'data' => $car
                ]);
            }

            return response()->json([
                'error' => 1,
                'message' => 'Ya hay una inspección abierta para ese vehículo.'
            ]);
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

    public function getTypes(): JsonResponse
    {
        try {
            $carTypes = Rate::all();
            return response()->json([
                'error' => 0,
                'data' => $carTypes
            ]);
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
