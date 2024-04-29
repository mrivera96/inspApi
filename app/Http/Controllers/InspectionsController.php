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
            $inspections = Inspection::with(['car','car.model','car.model.brand', 'state', 'contract.customer', 'contract.checkOutAgency', 'contract.checkInAgency', 'checkoutAccessories', 'checkinAccessories', 'checkinAgent', 'checkoutAgent','checkoutDamages','checkoutDamages.damageType','checkoutDamages.damagePart','checkinDamages','checkinDamages.damageType','checkinDamages.damagePart'])->get();

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

            $newInspection->fotoLicencia = $request->fotoLicencia;
            if ($newInspection->fotoLicencia) {
                $documentImage = str_replace('data:image/png;base64,', '', $newInspection->fotoLicencia);
                $documentImage = str_replace(' ', '+', $documentImage);
                $imageName = Str::random(15) . time() . '.png';
                $path = "img/" . $newInspection->idInspeccion . "/licencia/";
                if (!\File::exists($path)) {
                    \File::makeDirectory($path, 0777, true);
                }
                \File::put($path . $imageName, base64_decode($documentImage));
                $newInspection->fotoLicencia = '/img/' . $newInspection->idInspeccion . '/licencia/' . $imageName;
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
                    \File::put($path . $imageDamageName, base64_decode($imageDamages));

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

            $savedInspection = Inspection::with(['car','car.model','car.model.brand', 'state', 'contract.customer', 'contract.checkOutAgency', 'contract.checkInAgency', 'checkoutAccessories', 'checkinAccessories', 'checkinAgent', 'checkoutAgent','checkoutDamages','checkoutDamages.damageType','checkoutDamages.damagePart','checkinDamages','checkinDamages.damageType','checkinDamages.damagePart'])->where('idInspeccion', $newInspection->idInspeccion)->first();

            return response()->json([
                'error' => 0,
                'data' => $savedInspection
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => 1,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function close(Request $request): JsonResponse
    {

        $newInspection = Inspection::where('idInspeccion', $request->idInspeccion)->first();

        $newInspection->odoEntrega = $request->odoEntrega;
        $newInspection->combEntrega = $request->combEntrega;
        $newInspection->comentariosLlantasDelanteras = $request->comentariosLlantasDelanteras;
        $newInspection->comentariosLlantasTraseras = $request->comentariosLlantasTraseras;
        $newInspection->comentariosBateria = $request->comentariosBateria;
        $newInspection->fechaEntrega = new Carbon(now());
        $newInspection->idUsuarioEntrega = Auth::user()->idUsuario;
        $newInspection->idEstado = 49;


        $damagesCheckin = $request->daniosEntrega;
        $accessoriesCheckin = $request->accesoriosEntrega;

        try {
            $newInspection->firmaClienteEntrega = $request->firmaClienteEntrega;

            if ($newInspection->firmaClienteEntrega) {
                $image = str_replace('data:image/png;base64,', '', $newInspection->firmaClienteEntrega);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(15) . time() . '.png';
                $path = "img/" . $newInspection->idInspeccion . "/firmas/entrega/";
                if (!\File::exists($path)) {
                    \File::makeDirectory($path, 0777, true);
                }
                \File::put($path . $imageName, base64_decode($image));
                $newInspection->firmaClienteEntrega = '/img/' . $newInspection->idInspeccion . '/firmas/entrega/' . $imageName;
                $newInspection->update();
            }


            if ($accessoriesCheckin != null) {
                foreach ($accessoriesCheckin as $accessory) {
                    $newInspectionAccessory = new InspectionAccesories();
                    $newInspectionAccessory->idInspeccion = $newInspection->idInspeccion;
                    $newInspectionAccessory->idAccesorio = $accessory['idAccesorio'];
                    $newInspectionAccessory->etapa = "checkin";
                    $newInspectionAccessory->save();
                }
            }

            if ($damagesCheckin != null) {
                foreach ($damagesCheckin as $damage) {
                    $imageDamages = str_replace('data:image/png;base64,', '', $damage['foto']);
                    $imageDamages = str_replace(' ', '+', $imageDamages);
                    $imageDamageName = Str::random(15) . time() . '.png';
                    $path = "img/" . $newInspection->idInspeccion . "/daniosEntrega/";
                    if (!\File::exists($path)) {
                        \File::makeDirectory($path, 0777, true);
                    }
                    \File::put($path . $imageDamageName, base64_decode($imageDamages));

                    $newDamage = new Damage();
                    $newDamage->idInspeccion = $newInspection->idInspeccion;
                    $newDamage->idPieza = $damage['idPieza'];
                    $newDamage->idTipoDanio = $damage['idTipoDanio'];
                    $newDamage->etapa = "checkin";
                    $newDamage->usuarioCreacion = Auth::user()->idUsuario;
                    $newDamage->fotos = '/img/' . $newInspection->idInspeccion . '/daniosEntrega/' . $imageDamageName;
                    $newDamage->save();
                }
            }

            $savedInspection = Inspection::with(['car','car.model','car.model.brand', 'state', 'contract.customer', 'contract.checkOutAgency', 'contract.checkInAgency', 'checkoutAccessories', 'checkinAccessories', 'checkinAgent', 'checkoutAgent','checkoutDamages','checkoutDamages.damageType','checkoutDamages.damagePart','checkinDamages','checkinDamages.damageType','checkinDamages.damagePart'])->where('idInspeccion', $newInspection->idInspeccion)->first();

            return response()->json([
                'error' => 0,
                'data' => $savedInspection
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => 1,
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

}
