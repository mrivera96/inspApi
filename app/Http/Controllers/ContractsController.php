<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    public function list(): JsonResponse
    {
        try {

            $contracts = Contract::with(
                [
                    'checkOutAgency',
                    'checkInAgency',
                    'car:idVehiculo,nemVehiculo,numMatricula,idModeloVehiculo,modelo,nemVehiculo,odometro,idEstado',
                    'car.model:idModeloVehiculo,idMarcaVehiculo', 'car.model.brand:idMarcaVehiculo,descMarca',
                    'customer:idCliente,nomCliente,correoI,celularI',

                ]
            )->where('idEstado', 9)->select('idContrato', 'idVehiculo', 'idEstado', 'idCliente', 'numContrato','idAgenciaSalida','idAgenciaEntrega')->get();

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
}
