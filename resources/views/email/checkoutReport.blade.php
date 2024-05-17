<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inspección de Salida</title>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="container p-4">

    <table>
        <tbody>
        <tr>
            <td>
                <img class="img" src="https://xplorerentacar.com/wp-content/uploads/2020/02/logo-xplore-marcas.png"
                     alt="Xplore Rent a Car" id="logo" width="200px">
            </td>
            <td>

            </td>

            <td>
                <strong style="color: darkblue;">ALQUILER DE CARROS, S.A. DE C.V.</strong> <br>
                <strong style="color: darkblue;">RTN: 08019007056250</strong>
            </td>
        </tr>
        </tbody>
    </table>

    <div class="row">
        <p>Tegucigalpa, M.D.C.
            <br>{{$today}}
        </p>
    </div>

    <div class="card" style="border-radius: 10px">

        <div class="card-body">

            <div class="row">
                <div class="col">
                    <h3 class="card-title">Inspección No. {{$currentInspection->numInspeccion}}</h3>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <i class="fas fa-bars"></i>
                    Estado: {{$currentInspection->state->descEstado}}
                </div>

                <div class="col">
                    <i class="fas fa-file-invoice"></i>
                    Contrato No: {{$currentInspection->contract->numContrato}}

                </div>
                <div class="col">
                    <i class="fas fa-circle-user"></i>
                    Cliente:
                    {{$currentInspection->contract->customer->nomCliente}}

                </div>
            </div>
            <div>
                <i class="fas fa-car"></i>
                <p
                >Vehículo: {{$currentInspection->car->nemVehiculo}} |
                    {{$currentInspection->car->model->brand->descMarca}}
                    {{$currentInspection->car->modelo}}</p
                >
            </div>

        </div>
    </div>
    <div class="card" style="border-radius: 10px">

        <div class="card-body">
            <h3 class="card-title">Salida</h3>

            <ion-list-header>
                <p>Datos generales</p>
            </ion-list-header>
            <div>
                <i class="fas fa-building-circle-arrow-right"></i>
                <p
                >Agencia:
                    {{$currentInspection->contract->checkOutAgency->descAgencia}}</p
                >
            </div>
            <div>
                <i class="fas fa-gauge"></i>
                <p
                >Kilometraje: {{$currentInspection->odoSalida }}</p
                >
            </div>
            <div>
                <i class="fas fa-gas-pump"></i>
                <p
                >Nivel de combustible:
                    {{$currentInspection->checkOutFuel->descTanqueComb}}</p
                >
            </div>
            <div>
                <i class="fas fa-user-tie"></i>
                <p
                >Agente:
                    {{$currentInspection->checkoutAgent->nomUsuario}}</p
                >
            </div>
            <div>
                <i class="fas fa-id-card"></i>
                <p>Licencia:</p>
            </div>
            <div>
                @if ($currentInspection->fotoLicencia != null)
                    {

                    <img
                        src="{{$currentInspection->fotoLicencia}}"
                    >
                    }
                @else
                    {
                    <p>Sin registro</p>
                    }
                @endif
            </div>
            <div>
                <i class="fas fa-camera"></i>
                <p>Fotografías:</p>
            </div>
            @if (sizeof($currentInspection->photos)>0)
                {

                @foreach ($currentInspection->photos as $photo)
                    {
                    @if($photo->etapa == 'checkout')
                        {
                        <div class="col">
                            <div class="card">

                                <div class="card-body">
                                    <h3 class="card-title">{{$photo->autoPart->descPieza}}</h3>
                                    <img
                                        src=" {{$photo->foto}}"
                                    >

                                </div>
                            </div>
                        </div>
                        }
                    @endif
                    }
                @endforeach

                }
            @else
                {
                <div>
                    <p>Sin registro</p>
                </div>
                }
            @endif


            <div>

                <h3>Accesorios</h3>

                @foreach ($accessories as $accessory )
                    {
                    <div>
                        <input
                            disabled
                            checked="accessory.isInCheckout"
                        >{{ $accessory->nomAccesorio }}
                    </div>
                    }
                @endforeach
            </div>


        </div>
    </div>


</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>

<!--
<ion-list>
    <ion-list-header>
        <p>Adicional</p>
    </ion-list-header>
    <div lines="none">
        <fa-icon slot="start" [icon]="wheel"></fa-icon>
        <p>Notas Llantas delanteras:</p>
    </div>
    <div>
        <p
        >{{$currentInspection->comentariosLlantasDelanteras || 'Sin Registro'}}</p
        >
    </div>
    <div lines="none">
        <fa-icon slot="start" [icon]="wheel"></fa-icon>
        <p>Notas Llantas traseras:</p>
    </div>
    <div>
        <p
        >{{$currentInspection->comentariosLlantasTraseras ||
            'SinRegistro'}}</p
        >
    </div>
    <div lines="none">
        <fa-icon slot="start" [icon]="battery"></fa-icon>
        <p>Notas batería:</p>
    </div>
    <div>
        <p
        >{{$currentInspection->comentariosBateria ||
            'SinRegistro'}}</p
        >
    </div>
    <div lines="none">
        <p>Firma del cliente</p>
    </div>
    <div>
        if($currentInspection->firmaClienteSalida = undefined){
        <ion-img-viewer
            title="Firma del Cliente OUT"
            text="Preview"
            scheme="light"
            [src]="photosDirectory + $currentInspection.firmaClienteSalida"
        >
        </ion-img-viewer>

        }else {
        <p>Sin Registro</p>
        }
    </div>

        -->
