<?php /** @noinspection ALL */
/** @noinspection ALL */

/** @noinspection PhpArithmeticTypeCheckInspection */

namespace App\Http\Controllers;


use App\Models\Agency;
use App\Models\Damage;
use App\Models\Inspection;
use App\Models\InspectionAccesories;
use App\Models\InspectionPhoto;
use App\Models\Accessory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Mail;


class InspectionsController extends Controller
{
    public function list(): JsonResponse
    {
        try {
            $inspections = Inspection::with(['car', 'car.model', 'car.model.brand', 'state', 'contract.customer', 'contract.checkOutAgency', 'contract.checkInAgency', 'checkoutAccessories', 'checkinAccessories', 'checkinAgent', 'checkoutAgent', 'damages', 'damages.photo', 'damages.damageType', 'damages.damagePart', 'photos.autoPart', 'checkOutFuel', 'checkInFuel'])
			->orderBy('created_at','desc')->get();

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

    /** @noinspection PhpArithmeticTypeCheckInspection */
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
        $newInspection->comentariosLlantaRepuesto = $request->comentariosLlantaRepuesto;
        $newInspection->comentariosBateria = $request->comentariosBateria;
        $newInspection->otrasObservacionesSalida = $request->otrasObservacionesSalida;
        $newInspection->fechaSalida = new Carbon(now());
        $newInspection->idUsuarioSalida = Auth::user()->idUsuario;
        $newInspection->usuarioCreacion = Auth::user()->idUsuario;
        $newInspection->idEstado = 48;
        $newInspection->correoCliente = $request->correoCliente;
        $newInspection->correoConductor = $request->correoConductor;
        $checkoutPhotos = $request->photos;
        $accessoriesCheckout = $request->accesoriosSalida;

        try {
            $exists = Inspection::where(['idEstado'=>48, 'idVehiculo'=>$request->idVehiculo])->exists();

            if($exists){
                return response()->json([
                    'error' => 1,
                    'message' => 'Ya hay una inspección pendiente para este vehiculo'
                ],500);


            }
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

            if ($checkoutPhotos != null) {
                foreach ($checkoutPhotos as $photo) {
                    $image = str_replace('data:image/png;base64,', '', $photo['foto']);
                    $image = str_replace(' ', '+', $image);
                    $imageName = Str::random(15) . time() . '.png';
                    $path = "img/" . $newInspection->idInspeccion . "/fotosSalida/";
                    if (!\File::exists($path)) {
                        \File::makeDirectory($path, 0777, true);
                    }
                    \File::put($path . $imageName, base64_decode($image));

                    $newPhoto = new InspectionPhoto();
                    $newPhoto->idInspeccion = $newInspection->idInspeccion;
                    $newPhoto->idPieza = $photo['idPieza'];
                    $newPhoto->etapa = $photo['etapa'];
                    $newPhoto->usuarioCreacion = Auth::user()->idUsuario;
                    $newPhoto->foto = '/img/' . $newInspection->idInspeccion . '/fotosSalida/' . $imageName;
                    $newPhoto->save();
                }
            }

            $savedInspection = Inspection::with(['car', 'car.model', 'car.model.brand', 'state', 'contract.customer', 'contract.checkOutAgency', 'contract.checkInAgency', 'checkoutAccessories', 'checkinAccessories', 'checkinAgent', 'checkoutAgent', 'photos.autoPart', 'checkOutFuel', 'checkInFuel'])->where('idInspeccion', $newInspection->idInspeccion)->first();
            $this->sendEmail($savedInspection);
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
        $newInspection->comentariosLlantaRepuesto = $request->comentariosLlantaRepuesto;
        $newInspection->comentariosBateria = $request->comentariosBateria;
        $newInspection->otrasObservacionesEntrega = $request->otrasObservacionesEntrega;
        $newInspection->fechaEntrega = new Carbon(now());
        $newInspection->idUsuarioEntrega = Auth::user()->idUsuario;
        $newInspection->usuarioModificacion = Auth::user()->idUsuario;
        $newInspection->idEstado = 49;
        $newInspection->correoCliente = $request->correoCliente;
        $newInspection->correoConductor = $request->correoConductor;


        $checkinPhotos = $request->photos;
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
					$exists = InspectionAccesories::where([
					['idInspeccion',$newInspection->idInspeccion],
					['idAccesorio',$accessory['idAccesorio']],
					['etapa','checkin']
					])->count();
					if($exists = 0){
						$newInspectionAccessory = new InspectionAccesories();
						$newInspectionAccessory->idInspeccion = $newInspection->idInspeccion;
						$newInspectionAccessory->idAccesorio = $accessory['idAccesorio'];
						$newInspectionAccessory->etapa = "checkin";
						$newInspectionAccessory->save();
					}
                }
            }

            if ($checkinPhotos != null) {
                foreach ($checkinPhotos as $photo) {
                    if (Str::length($photo['foto']) > 100) {
                        $image = str_replace('data:image/png;base64,', '', $photo['foto']);
                        $image = str_replace(' ', '+', $image);
                        $imageName = Str::random(15) . time() . '.png';
                        $path = "img/" . $newInspection->idInspeccion . "/fotosEntrada/";
                        if (!\File::exists($path)) {
                            \File::makeDirectory($path, 0777, true);
                        }
                        \File::put($path . $imageName, base64_decode($image));

                        $newPhoto = new InspectionPhoto();
                        $newPhoto->idInspeccion = $newInspection->idInspeccion;
                        $newPhoto->idPieza = $photo['idPieza'];
                        $newPhoto->etapa = 'checkin';
                        $newPhoto->usuarioCreacion = Auth::user()->idUsuario;
                        $newPhoto->foto = '/img/' . $newInspection->idInspeccion . '/fotosEntrada/' . $imageName;
                        $newPhoto->save();

                        if ($photo['damage'] != null) {
                            $newDamage = new Damage();
                            $newDamage->idInspeccion = $newInspection->idInspeccion;
                            $newDamage->idPieza = $photo['idPieza'];
                            $newDamage->idTipoDanio = $photo['damage']['idTipoDanio'];
                            $newDamage->etapa = 'checkin';
                            $newDamage->idFoto = $newPhoto->idFoto;
                            $newDamage->usuarioCreacion = Auth::user()->idUsuario;
                            $newDamage->save();
                        }
                    }
                }
            }

            $savedInspection = Inspection::with(['car', 'car.model', 'car.model.brand', 'state', 'contract.customer', 'contract.checkOutAgency', 'contract.checkInAgency', 'checkoutAccessories', 'checkinAccessories', 'checkinAgent', 'checkoutAgent', 'damages.photo', 'damages.photo', 'damages.damageType', 'damages.damagePart', 'photos.autoPart', 'checkOutFuel', 'checkInFuel'])->where('idInspeccion', $newInspection->idInspeccion)->first();

            $this->sendEmail($savedInspection);
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

    public function print(Request $request)
    {
        try {
            $currentInspection = Inspection::with(
                [
                    'car', 'car.model', 'car.model.brand', 'state',
                    'contract.customer', 'contract.checkOutAgency',
                    'contract.checkInAgency', 'checkoutAccessories',
                    'checkinAccessories', 'checkinAgent', 'checkoutAgent',
                    'photos.autoPart', 'checkOutFuel', 'checkInFuel'
                ]
            )
                ->where('idInspeccion', $request->idInspeccion)
                ->first();

            $today = Carbon::today()->format('d/m/Y');
            $photosDirectory = env('APP_URL');
            $accessories = Accessory::where('isActivo', 1)->orderBy('nomAccesorio')->get();


            $view = 'emails.midSizeReport';

            $pdf = PDF::loadView($view, compact('currentInspection', 'today', 'accessories', 'photosDirectory'))
                ->setOption('margin-left', 5)
                ->setOption('margin-right', 5);

            return response()
                ->json([
                    'error' => 0,
                    'data' => base64_encode($pdf->output())
                ], 200);
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

    private function sendEmail($currentInspection)
    {
        $today = Carbon::today()->format('d/m/Y');
        $photosDirectory = env('APP_URL');
        $accessories = Accessory::where('isActivo', 1)->orderBy('nomAccesorio')->get();

        $view = 'emails.midSizeReport';

        $pdf = PDF::loadView($view, compact('currentInspection', 'today', 'accessories', 'photosDirectory'))
            ->setOption('margin-left', 5)
            ->setOption('margin-right', 5);

        $data["emails"] = $currentInspection->correoCliente;
        $cc = [];
        if ($currentInspection->correoConductor != null && $currentInspection->correoConductor != '') {
            array_push($cc, ['email' => $currentInspection->correoConductor, 'name' => '']);
        }
        if ($currentInspection->checkOutAgency->correoPrincipal != null && $currentInspection->checkOutAgency != '') {
            array_push($cc, ['email' => $currentInspection->checkOutAgency->correoPrincipal, 'name' => '']);
        }
        $data["cc"] = $cc;
        $data["client_name"] = $currentInspection->contract->customer->nomCliente;
        if ($currentInspection->idEstado == 48) {

        }
        $data["title"] = $currentInspection->idEstado == 48 ? "Inspección de Salida de Vehículo ".$currentInspection->car->nemVehiculo. " - No. " . $currentInspection->numInspeccion : "Inspección de Entrada de Vehículo ".$currentInspection->car->nemVehiculo. " - No. " . $currentInspection->numInspeccion;
        $data["body"] = "This is Demo";
        $data["tipoInspeccion"] = $currentInspection->idEstado == 48 ? "Salida" : "Entrada" ;
        $data["currentInspection"] = $currentInspection;
        $data["today"] = $today;
        $data["accessories"] = $accessories;
        $data["photosDirectory"] = $photosDirectory;
        $data["from"] = env('MAIL_FROM_ADDRESS');

        Mail::sendNow('emails.body', $data, function ($message) use ($data, $pdf) {
            $message->from($data['from'], 'Xplore Rent A Car')
                ->to($data["emails"], $data["client_name"])
                ->cc($data["cc"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "Inspeccion " . $data["currentInspection"]["numInspeccion"] . ".pdf");
        });
    }

}
