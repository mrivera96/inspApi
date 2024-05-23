<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('/assets/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet"
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
        body {
            font-size: 10px;
        }
    </style>
</head>

<body>


<div class="container-fluid">


    <div class="panel panel-default" style="border-radius: 10px">

        <div class="panel-header">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="img"
                             src="https://xplorerentacar.com/wp-content/uploads/2020/02/logo-xplore-marcas.png"
                             alt="Xplore Rent a Car" id="logo" width="100px">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <p class="pl-1">Tegucigalpa, M.D.C.
                            <br>{{$today}}
                        </p>
                    </div>


                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <strong style="color: #00008BFF;"><p>ALQUILER DE CARROS, S.A. DE C.V.
                            <br> RTN: 08019007056250</p></strong>
                </div>

            </div>
        </div>

        <div class="panel-body">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5 class="panel-title">Inspección No. {{$currentInspection->numInspeccion}}</h5>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <i class="fas fa-file-invoice"></i>
                    Contrato No: {{$currentInspection->contract->numContrato}}
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <i class="fas fa-circle-user"></i>
                    Cliente:
                    {{$currentInspection->contract->customer->nomCliente}}
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <i class="fas fa-car"></i>
                    Vehículo: {{$currentInspection->car->nemVehiculo}} |
                    {{$currentInspection->car->model->brand->descMarca}}
                    {{$currentInspection->car->modelo}}
                </div>

            </div>
            <div class="row">

            </div>


        </div>
    </div>

    <div class="panel panel-default" style="border-radius: 10px">

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h4 class="panel-title">Datos de Salida</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h5>Datos generales</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <i class="fas fa-building-circle-arrow-right"></i>
                    Agencia:
                    {{$currentInspection->contract->checkOutAgency->descAgencia}}
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <i class="fas fa-gauge"></i>
                    Kilometraje: {{$currentInspection->odoSalida }}
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <i class="fas fa-gas-pump"></i>
                    Nivel de combustible:
                    {{$currentInspection->checkOutFuel->descTanqueComb}}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <i class="fas fa-user-tie"></i>
                    Agente:
                    {{$currentInspection->checkoutAgent->nomUsuario}}
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <i class="fas fa-calendar"></i>
                    Fecha de salida:
                    {{Carbon\Carbon::create($currentInspection->fechaSalida)->format('d/m/Y')}}
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h4>Accesorios</h4>
                </div>
            </div>

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                        @foreach ($accessories as $accessory )
                            @if($currentInspection->checkoutAccessories->contains($accessory))
                                <label>
                                    <input
                                        style="color:#f58220 !important;"
                                        type="checkbox"
                                        checked="true"
                                    > {{ $accessory->nomAccesorio }}
                                </label>

                            @else
                                <label>
                                    <input
                                        type="checkbox"
                                        disabled
                                    > {{ $accessory->nomAccesorio }}
                                </label>

                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h4>
                        Fotografías:
                    </h4>
                </div>
            </div>

            <div class="row">


                @forelse ($currentInspection->photos as $photo)
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

                        @if($photo->etapa == 'checkout')
                            <div>
                                <p>{{$photo->autoPart->descPieza}}</p>
                                <img
                                    height="50px"
                                    src="{{$photosDirectory.$photo->foto}}"
                                >
                            </div>

                        @endif

                    </div>
                @empty($currentInspection->photos)
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <p>Sin Registro</p>
                    </div>
                @endforelse


            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Licencia:</h5>
                </div>
            </div>

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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


            <div class="row">


                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4>Adicional</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <i class="fas fa-circle-dot"></i>
                            Notas Llantas delanteras:
                            {{$currentInspection->comentariosLlantasDelanteras || 'Sin Registro'}}
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <i class="fas fa-circle-dot"></i>
                            Notas Llantas traseras:
                            {{$currentInspection->comentariosLlantasTraseras ||
            'SinRegistro'}}
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
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
                            height="100px"
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

<script src="{{asset('/assets/js/bootstrap/bootstrap.js')}}"
></script>
</body>

</html>

<!--
<ion-list>
    <ion-list-header>
        <p>Adicional</p>
    </ion-list-header>



        -->
