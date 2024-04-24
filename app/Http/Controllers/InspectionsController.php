<?php

namespace App\Http\Controllers;


use App\Models\Car;
use App\Models\Damage;
use App\Models\Inspection;
use App\Models\InspectionAccesories;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;


class InspectionsController extends Controller
{
    public function list(): JsonResponse
    {
        try {
            $inspections = Inspection::with(['car', 'state', 'contract.customer'])->get();

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

        $newInspection = new Inspection();
        $newInspection->idVehiculo = $request->idVehiculo;
        $newInspection->idContrato = $request->idContrato;
        $newInspection->idCliente = $request->idCliente;
        $newInspection->nomRecibeVehiculo = $request->nomRecibeVehiculo;
        $newInspection->idAgenciaSalida = $request->idAgenciaSalida;
        $newInspection->odoSalida = $request->odoSalida;
        $newInspection->combSalida = $request->combSalida;
        $newInspection->comentariosLlantasDelanteras = $request->comentariosLlantasDelanteras;
        $newInspection->comentariosLlantasTraseras = $request->comentariosLlantasTraseras;
        $newInspection->comentariosBateria = $request->comentariosBateria;
        $newInspection->fechaSalida = new Carbon($request->fechaSalida);
        $newInspection->idUsuarioSalida = Auth::user()->idUsuario;
        $newInspection->idEstado = 48;


        $damagesCheckout = $request->daniosSalida;
        $accessoriesCheckout = $request->accesoriosSalida;

        try {
            $newInspection->save();
            $newInspection->firmaClienteSalida = $request->firmaClienteSalida;

            if ($newInspection->firmaClienteSalida) {
                $image = str_replace('data:image/png;base64,', '', $newInspection->firmaClienteSalida);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(15) . time() . '.png';
                $path = "img/" . $newInspection->idInspeccion . "/firmas/salida/";
                if (!\File::exists($path)) {
                    \File::makeDirectory($path, 0777, true);
                }
                \File::put($path . $imageName, base64_decode($image));
                $newInspection->firmaClienteSalida = '/img/' . $newInspection->idInspeccion . '/firmas/salida/' . $imageName;
                $newInspection->save();
            }


            if ($accessoriesCheckout != null) {
                foreach ($accessoriesCheckout as $accessory) {
                    $newInspectionAccessory = new InspectionAccesories();
                    $newInspectionAccessory->idInspeccion = $newInspection->idInspeccion;
                    $newInspectionAccessory->idAccesorio = $accessory['idAccesorio'];
                    $newInspectionAccessory->etapa = "checkout";
                    $newInspectionAccessory->save();
                }
            }

            if ($damagesCheckout != null) {
                foreach ($damagesCheckout as $damage) {
                    $imageDamages = str_replace('data:image/png;base64,', '', $damage['foto']);
                    $imageDamages = str_replace(' ', '+', $imageDamages);
                    $imageDamageName = Str::random(15) . time() . '.png';
                    $path = "img/" . $newInspection->idInspeccion . "/daniosSalida/";
                    if (!\File::exists($path)) {
                        \File::makeDirectory($path, 0777, true);
                    }
                    \File::put($path . $imageName, base64_decode($image));

                    $newDamage = new Damage();
                    $newDamage->idInspeccion = $newInspection->idInspeccion;
                    $newDamage->idPieza = $damage['idPieza'];
                    $newDamage->idTipoDanio = $damage['idTipoDanio'];
                    $newDamage->etapa = "checkout";
                    $newDamage->usuarioCreacion = Auth::user()->idUsuario;
                    $newDamage->fotos = '/img/' . $newInspection->idInspeccion . '/daniosSalida/' . $imageDamageName;
                    $newDamage->save();
                }
            }


            return response()->json([
                'error' => 0,
                'data' => $newInspection
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
            $inspection = Inspection::with(['estado', 'car.model.brand', 'checkOutAgency'])
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
