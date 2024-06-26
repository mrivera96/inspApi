<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Exception;
use Illuminate\Http\JsonResponse;

class ContractsController extends Controller
{
    public function list(): JsonResponse
    {
        try {

            $contracts = Contract::with(
                [
                    'checkOutAgency',
                    'checkInAgency', 'checkOutFuel', 'checkInFuel',
                    'car:idVehiculo,nemVehiculo,numMatricula,idModeloVehiculo,modelo,nemVehiculo,odometro,idEstado,color',
                    'car.model:idModeloVehiculo,idMarcaVehiculo', 'car.model.brand:idMarcaVehiculo,descMarca',
                    'customer:idCliente,nomCliente,correoI,celularI',
                    'inspection',
                    'driver',
                    'additionalDriver'

                ]
            )->whereIn('idEstado', [9,58])
			->select('idContrato','fechaRegistro', 'idVehiculo', 'idEstado', 'idCliente', 'numContrato', 'idAgenciaSalida', 'idAgenciaEntrega', 'idTanqueSal', 'idTanqueEnt', 'idConductor', 'idConductorAdic')
			->orderBy('fechaRegistro','desc')
			->get();

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
