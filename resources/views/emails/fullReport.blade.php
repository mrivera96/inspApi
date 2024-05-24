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

    <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <img class="img"
                         src="https://xplorerentacar.com/wp-content/uploads/2020/02/logo-xplore-marcas.png"
                         alt="Xplore Rent a Car" id="logo" width="100px">
                </div>
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <p class="pl-1">Tegucigalpa, M.D.C.
                <br>{{$today}}
            </p>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <strong style="color: #00008BFF;"><p>ALQUILER DE CARROS, S.A. DE C.V.
                    <br> RTN: 08019007056250</p></strong>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h5>Inspección No. {{$currentInspection->numInspeccion}}</h5>
        </div>
    </div>
    <div class="row">

        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <i class="fas fa-file-invoice"></i>
            Contrato No: {{$currentInspection->contract->numContrato}}
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <i class="fas fa-circle-user"></i>
            Cliente:
            {{$currentInspection->contract->customer->nomCliente}}
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <i class="fas fa-car"></i>
            Vehículo: {{$currentInspection->car->nemVehiculo}} |
            {{$currentInspection->car->model->brand->descMarca}}
            {{$currentInspection->car->modelo}}
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h5>Datos de Salida</h5>
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
            <h5>Accesorios</h5>
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
            <h5>
                Fotografías:
            </h5>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                @foreach ($currentInspection->photos as $photo)

                    @if($photo->etapa == 'checkout')

                        <img
                            id="photo"
                            alt="photo"
                            height="50px"
                            src="{{$photosDirectory.$photo->foto}}"
                        >

                    @endif

                @endforeach
            </div>
        </div>


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
                    height="50px"
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
                    <h5>Adicional</h5>
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
            <h5>Firma del cliente</h5>
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

    <!-- INICIO CHECKIN -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h5>Datos de Entrada</h5>
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
            {{$currentInspection->contract->checkInAgency->descAgencia}}
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <i class="fas fa-gauge"></i>
            Kilometraje: {{$currentInspection->odoEntrega }}
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <i class="fas fa-gas-pump"></i>
            Nivel de combustible:
            {{$currentInspection->checkInFuel->descTanqueComb}}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <i class="fas fa-user-tie"></i>
            Agente:
            {{$currentInspection->checkInAgent->nomUsuario}}
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <i class="fas fa-calendar"></i>
            Fecha de salida:
            {{Carbon\Carbon::create($currentInspection->fechaEntrega)->format('d/m/Y')}}
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h5>Accesorios</h5>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                @foreach ($accessories as $accessory )
                    @if($currentInspection->checkinAccessories->contains($accessory))
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
            <h5>
                Fotografías:
            </h5>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                @foreach ($currentInspection->photos as $photo)

                    @if($photo->etapa == 'checkin')

                        <img
                            id="photo"
                            alt="photo"
                            height="50px"
                            src="{{$photosDirectory.$photo->foto}}"
                        >

                    @endif

                @endforeach
            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h5>Firma del cliente</h5>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @if($currentInspection->firmaClienteEntrega )
                <img
                    height="100px"
                    src="{{$photosDirectory . $currentInspection->firmaClienteEntrega}}"
                >

            @else
                <p>Sin Registro</p>
            @endif
        </div>
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
