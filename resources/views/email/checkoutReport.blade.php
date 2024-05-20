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

<div class="container-fluid">


    <div class="row">
        <div class="col text-start">
            <img class="img" src="https://xplorerentacar.com/wp-content/uploads/2020/02/logo-xplore-marcas.png"
                 alt="Xplore Rent a Car" id="logo" width="200px">
        </div>
        <div class="col text-center">
            <p>Tegucigalpa, M.D.C.
                <br>{{$today}}
            </p>
        </div>
        <div class="col text-end">
            <strong style="color: darkblue;">ALQUILER DE CARROS, S.A. DE C.V.</strong><br>
            <strong style="color: darkblue;">RTN: 08019007056250</strong>
        </div>

    </div>
    <div class="row">

    </div>

    <div class="card" style="border-radius: 10px">

        <div class="card-body">

            <div class="row">
                <div class="col">
                    <h4 class="card-title">Inspección No. {{$currentInspection->numInspeccion}}</h4>
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

            </div>
            <div class="row">
                <div class="col">
                    <i class="fas fa-circle-user"></i>
                    Cliente:
                    {{$currentInspection->contract->customer->nomCliente}}

                </div>

                <div class="col">
                    <i class="fas fa-car"></i>
                    Vehículo: {{$currentInspection->car->nemVehiculo}} |
                    {{$currentInspection->car->model->brand->descMarca}}
                    {{$currentInspection->car->modelo}}
                </div>
            </div>


        </div>
    </div>
    <br>
    <div class="card" style="border-radius: 10px">

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h4 class="card-title">Salida</h4>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h5>Datos generales</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <i class="fas fa-building-circle-arrow-right"></i>
                            Agencia:
                            {{$currentInspection->contract->checkOutAgency->descAgencia}}
                        </div>
                        <div class="col-12">
                            <i class="fas fa-gauge"></i>
                            Kilometraje: {{$currentInspection->odoSalida }}
                        </div>
                        <div class="col-12">
                            <i class="fas fa-gas-pump"></i>
                            Nivel de combustible:
                            {{$currentInspection->checkOutFuel->descTanqueComb}}
                        </div>

                        <div class="col-12">
                            <i class="fas fa-user-tie"></i>
                            Agente:
                            {{$currentInspection->checkoutAgent->nomUsuario}}
                        </div>
                        <div class="col-12">
                            <i class="fas fa-calendar"></i>
                            Fecha de salida:
                            {{Carbon\Carbon::create($currentInspection->fechaSalida)->format('d/m/Y')}}
                        </div>

                    </div>
                </div>


                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h5>Licencia:</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @if ($currentInspection->fotoLicencia != null)

                                <img
                                    height="120px"
                                    src="{{$photosDirectory.$currentInspection->fotoLicencia}}"
                                >

                            @else
                                <p>Sin registro</p>

                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col">
                    <h5>
                        Fotografías:
                    </h5>

                </div>

            </div>
            <div class="row">
                @if (sizeof($currentInspection->photos)>0)

                    @foreach ($currentInspection->photos as $photo)

                        @if($photo->etapa == 'checkout')

                            <div class="col-4">

                                <h5>{{$photo->autoPart->descPieza}}</h5>
                                <img
                                    height="120px"
                                    src="{{$photosDirectory.$photo->foto}}"
                                >
                            </div>

                        @endif

                    @endforeach
            </div>

            @else

                <div>
                    <p>Sin registro</p>
                </div>

            @endif


            <div class="row">

                <div class="col">
                    <div class="row">
                        <div class="row ">
                            <div class="col">
                                <h4>Accesorios</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($accessories as $accessory )
                            <div class="col-6">
                                @if($currentInspection->checkoutAccessories->contains($accessory))

                                    <input
                                        style="color:#f58220 !important;"
                                        type="checkbox"
                                        checked="true"
                                    > {{ $accessory->nomAccesorio }}
                                @else
                                    <input
                                        type="checkbox"
                                        disabled
                                    > {{ $accessory->nomAccesorio }}
                                @endif
                            </div>

                        @endforeach
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h4>Adicional</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <i class="fas fa-circle-dot"></i>
                            Notas Llantas delanteras:
                            {{$currentInspection->comentariosLlantasDelanteras || 'Sin Registro'}}
                        </div>

                        <div class="col-12">
                            <i class="fas fa-circle-dot"></i>
                            Notas Llantas traseras:
                            {{$currentInspection->comentariosLlantasTraseras ||
            'SinRegistro'}}
                        </div>

                        <div class="col-12">
                            <i class="fas fa-battery"></i>
                            Notas batería: {{$currentInspection->comentariosBateria ||
            'SinRegistro'}}
                        </div>

                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <h4>Firma del cliente</h4>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    @if($currentInspection->firmaClienteSalida )
                        <img

                            src="{{$photosDirectory . $currentInspection->firmaClienteSalida}}"
                        >

                    @else
                        <p>Sin Registro</p>
                    @endif
                </div>

            </div>
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



        -->
