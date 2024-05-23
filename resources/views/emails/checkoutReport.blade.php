<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('/assets/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet"
    >
    <link href="{{asset('/assets/css/bootstrap/bootstrap-grid.min.css')}}" rel="stylesheet"
    >
    <link href="{{asset('/assets/css/font-awesome/brands.css')}}" rel="stylesheet"
    >
    <link href="{{asset('/assets/css/font-awesome/regular.css')}}" rel="stylesheet"
    >
    <link href="{{asset('/assets/css/font-awesome/solid.css')}}" rel="stylesheet"
    >
    <link href="{{asset('/assets/css/font-awesome/fontawesome.css')}}" rel="stylesheet"
    >
    <title>Inspección de Salida</title>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

<div class="container-fluid">

    <div class="row">
        <div class="col-4">
            <img class="img" src="https://xplorerentacar.com/wp-content/uploads/2020/02/logo-xplore-marcas.png"
                 alt="Xplore Rent a Car" id="logo" width="100px">

        </div>
        <div class="col-4">
            <strong style="color: #00008BFF;"><p>ALQUILER DE CARROS, S.A. DE C.V.
                    <br> RTN: 08019007056250</p></strong>
        </div>

        <div class="col-4">
            <p class="text-justify">Tegucigalpa, M.D.C.
                <br>{{$today}}
            </p>
        </div>

    </div>

    <div class="card card-default" style="border-radius: 10px">

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

            <div class="row">
                <div class="col">
                    <h5>Licencia:</h5>
                </div>
            </div>

            <div class="row">

                <div class="col">
                    @if ($currentInspection->fotoLicencia != null)
                        <img
                            height="100px"
                            src="{{$photosDirectory.$currentInspection->fotoLicencia}}"
                        >
                    @else
                        <p>Sin registro</p>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="card card-default" style="border-radius: 10px">

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h4 class="card-title">Salida</h4>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4>Datos generales</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <i class="fas fa-building-circle-arrow-right"></i>
                            Agencia:
                            {{$currentInspection->contract->checkOutAgency->descAgencia}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <i class="fas fa-gauge"></i>
                            Kilometraje: {{$currentInspection->odoSalida }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <i class="fas fa-gas-pump"></i>
                            Nivel de combustible:
                            {{$currentInspection->checkOutFuel->descTanqueComb}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <i class="fas fa-user-tie"></i>
                            Agente:
                            {{$currentInspection->checkoutAgent->nomUsuario}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <i class="fas fa-calendar"></i>
                            Fecha de salida:
                            {{Carbon\Carbon::create($currentInspection->fechaSalida)->format('d/m/Y')}}
                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4>Accesorios</h4>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($accessories as $accessory )
                            <div class="col-sm-6 col-md-6 col-lg-6">
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
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h4>
                        Fotografías:
                    </h4>
                </div>
            </div>
            <div class="row">
                @if (sizeof($currentInspection->photos)>0)

                    @foreach ($currentInspection->photos as $photo)

                        @if($photo->etapa == 'checkout')

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                                <h5>{{$photo->autoPart->descPieza}}</h5>
                                <img
                                    height="100px"
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


                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4>Adicional</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <i class="fas fa-circle-dot"></i>
                            Notas Llantas delanteras:
                            {{$currentInspection->comentariosLlantasDelanteras || 'Sin Registro'}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <i class="fas fa-circle-dot"></i>
                            Notas Llantas traseras:
                            {{$currentInspection->comentariosLlantasTraseras ||
            'SinRegistro'}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <i class="fas fa-battery"></i>
                            Notas batería: {{$currentInspection->comentariosBateria ||
            'SinRegistro'}}
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h4>Firma del cliente</h4>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    @if($currentInspection->firmaClienteSalida )
                        <img
                            width="300px"
                            src="{{$photosDirectory . $currentInspection->firmaClienteSalida}}"
                        >

                    @else
                        <p>Sin Registro</p>
                    @endif
                </div>
            </div>
        </div>


        <br>
    </div>


</div>


<script src="{{asset('/assets/js/jquery-3.4.1.slim.min.js')}}"
></script>

<script src="{{asset('/assets/js/bootstrap/bootstrap.min.js')}}"
></script>
</body>

</html>

<!--
<ion-list>
    <ion-list-header>
        <p>Adicional</p>
    </ion-list-header>



        -->
