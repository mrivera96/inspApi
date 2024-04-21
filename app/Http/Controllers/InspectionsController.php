<?php

namespace App\Http\Controllers;


use App\Models\Car;
use App\Models\Inspection;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class InspectionsController extends Controller
{
    public function list(): JsonResponse
    {
        try {
            $inspections = Inspection::with(['car','state'])->get();

            return response()->json(
                [
                    'error' => 0,
                    'data' => $inspections
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

    public static function inspectionByCar($idVehiculo): int
    {
        return Inspection::where('idVehiculo', $idVehiculo)->where('idEstado', 32)->count();
    }

    public function create(Request $request): JsonResponse
    {
        $newInspection = $request->newInspection;
        $accessories = $newInspection->accessories;
        $generalData = $newInspection->generalData;
        $damages = $newInspection->damages;
        $sign = $newInspection->sign;
        $additionalComments = $newInspection->additionalComments;

        try {
            $newInspection = new Inspection();
            $id = Car::where('nemVehiculo', $generalData['nVehiculo'])->get()->first();
            $newInspection->idVehiculo = $id->idVehiculo;
            $newInspection->idAgenciaSalida = $checkoutData['idAgenciaSalida'];
            $newInspection->combSalida = $checkoutData['combSalida'];
            $newInspection->rendCombSalida = $checkoutData['rendCombSalida'];
            $newInspection->odoSalida = $checkoutData['odoSalida'];
            $date = date('Y-m-d', strtotime($checkoutData['fechaSalida']));
            $time = $checkoutData['horaSalida'];
            $datetime = $date . ' ' . $time;
            $newInspection->fechaSalida = new Carbon($datetime);
            $newInspection->idUsuarioSalida = Auth::user()->idUsuario;

            if ($sign['firmaClienteSalida']) {
                $image = str_replace('data:image/png;base64,', '', $sign['firmaClienteSalida']);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(15) . time() . '.png';
                \File::put(public_path() . '/img/firmas/' . $imageName, base64_decode($image));
                $newInspection->firmaClienteSalida = '/img/firmas/' . $imageName;
            }

            if ($damages != null) {
                $imageDamages = str_replace('data:image/png;base64,', '', $damages);
                $imageDamages = str_replace(' ', '+', $imageDamages);
                $imageDamageName = Str::random(15) . time() . '.png';
                \File::put(public_path() . '/img/danios/' . $imageDamageName, base64_decode($imageDamages));
                $newInspection->daniosSalida = '/img/danios/' . $imageDamageName;
            }

            $newInspection->nomRecibeVehiculo = $sign['nomRecibeVehiculo'];
            $newInspection->idEstado = 48;
            $newInspection->fechaProceso = Carbon::now('America/Tegucigalpa');

            $newInspection->save();
            InspectionAccessoriesController::insertarAccesorio($accessories, $newInspection->idInspeccion);

            return response()->json([
                'error' => 0,
                'data' => $newInspection->idInspeccion
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => 1,
                'request' => $request->datosGenerales,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function getById(Request $request): JsonResponse
    {
        try {
            $inspection = Inspection::with(['estado','car.model.brand','checkOutAgency'])
                ->where('idInspeccion', $request->idInspeccion)
                ->get()
                ->first();
            return response()->json(
                [
                    'error' => 0,
                    'data' => $inspection
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

    public function close(Request $request): JsonResponse
    {
        $dEntrega = $request->form;
        $idInspeccion = $request->idInspeccion;
        try {
            $currfInspeccion = Inspection::where('idInspeccion', $idInspeccion);
            $date = date('Y-m-d', strtotime($dEntrega['fechaEntrega']));
            $time = $dEntrega['horaEntrega'];
            $datetime = $date . ' ' . $time;
            if ($dEntrega['firmaClienteEntrega']) {
                $image = str_replace('data:image/png;base64,', '', $dEntrega['firmaClienteEntrega']);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(15) . time() . '.png';
                \File::put(public_path() . '/img/firmas/' . $imageName, base64_decode($image));
            }
            $currfInspeccion->update([
                'idAgenciaEntrega' => $dEntrega['idAgenciaEntrega'],
                'combEntrega' => $dEntrega['combEntrega'],
                'rendCombEntrega' => $dEntrega['rendCombEntrega'],
                'odoEntrega' => ['odoEntrega'],
                'fechaEntrega' => $datetime,
                'nomEntregaVehiculo' => $dEntrega['nomEntregaVehiculo'],
                'idUsuarioSalida' => Auth::user()->idUsuario,
                'firmaClienteSalida' => '/img/firmas/' . $imageName,
                'idEstado' => 49
            ]);

            return response()->json([
                'error' => 0,
                'message' => 'La inspección ha sido cerrada correctamente.'
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => 1,
                'request' => $request->datosGenerales,
                'message' => $ex->getMessage()
            ]);
        }
    }
}
