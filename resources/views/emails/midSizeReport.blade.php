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
    <title>Reporte de Inspección</title>
    <style>
        body {
            font-size: 9px;
            font-family: 'Arial', sans-serif;
        }

        @page {
            margin: 5px;
        }

        .wrapper-page {
            page-break-after: always;
        }

        .wrapper-page:last-child {
            page-break-after: avoid;
        }
    </style>
</head>

<body>


<div class="container-fluid">

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <img class="img"
                         src="{{asset('/assets/img/logo_xplore.png')}}"
                         alt="Xplore Rent a Car" id="logo" width="140px">
                </div>
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
            <strong style="color: #00008BFF;"><p>
                    DOCUMENTO DE INSPECCIÓN <br>
                    ALQUILER DE CARROS, S.A.
                    <br> RTN: 08019007056250</p></strong>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="background-color: #dcdcdc;">
            <h4 style="margin: 0 !important;padding: 0 !important;"><strong> Inspección No.
                    <br> {{$currentInspection->numInspeccion}}</strong></h4>
        </div>

    </div>
    <div class="row">
        <hr>
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

    <div class="row" style="background-color: #000000; color: #FFFFFF">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <strong>DATOS DE SALIDA</strong>
        </div>
    </div>

    <div class="row" style="background-color: #dcdcdc">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <strong>Datos generales</strong>
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
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <i class="fas fa-calendar"></i>
            Fecha de salida:
            {{Carbon\Carbon::create($currentInspection->contract->fechaSalida)->format('d/m/Y h:m')}}
        </div>

    </div>
    <br>
    <div class="row" style="background-color: #dcdcdc">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <strong>Accesorios</strong>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                @foreach ($accessories as $accessory )
                    @if($currentInspection->checkoutAccessories->contains($accessory))
                        <i class="fa-regular fa-square-check"></i> {{ $accessory->nomAccesorio }}
                    @else
                        <i class="fa-regular fa-square"></i> {{ $accessory->nomAccesorio }}
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <div class="row" style="background-color: #dcdcdc">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <strong>
                Fotografías
            </strong>
        </div>
    </div>
    <br>
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-0">
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 mb-0">
                @if(sizeof($currentInspection->photos)>0)
                    @foreach ($currentInspection->photos as $photo)

                        @if($photo->etapa == 'checkout')

                            <img
                                id="photo"
                                alt="photo"
                                height="70px"
                                src="{{public_path($photo->foto)}}"
                            >

                        @endif

                    @endforeach
                @else
                    <p>Sin Registro</p>
                @endif

                @if($currentInspection->fotoLicencia != null)
                    <img
                        height="70px"
                        src="{{public_path($currentInspection->fotoLicencia)}}"
                    >
                @endif
            </div>
        </div>
    </div>
    <br>
    <div class="row text-center" style="background-color: #dcdcdc">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
            <strong>Notas Adicionales</strong>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
            <strong>Firma del cliente</strong>
        </div>
    </div>
    <br>
    <div class="row">

        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 mt-1">

            <i class="fas fa-circle-dot"></i>
            Notas Llantas delanteras:
            {{$currentInspection->comentariosLlantasDelanteras }}
            <br>
            <i class="fas fa-circle-dot"></i>
            Notas Llantas traseras:
            {{$currentInspection->comentariosLlantasTraseras }}
            <br>
            <i class="fas fa-battery"></i>
            Notas batería: {{$currentInspection->comentariosBateria }}
            <br>
            <i class="fas fa-clipboard"></i>
            Otras Observaciones:
            {{$currentInspection->otrasObservacionesSalida}}
        </div>
        @if($currentInspection->firmaClienteSalida )
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right mt-1">
                <img
                    height="70px"
                    width="300px"
                    src="{{public_path( $currentInspection->firmaClienteSalida)}}"
                >
            </div>
        @else
            <p>Sin Registro</p>
        @endif
    </div>
    <br>
    @if($currentInspection->idEstado ==49)

        <div class="row" style="background-color: #000000; color: #FFFFFF">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <strong>DATOS DE ENTRADA</strong>
            </div>
        </div>

        <div class="row text-center" style="background-color: #dcdcdc">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <strong>Datos generales</strong>
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
                {{$currentInspection->checkinAgent->nomUsuario}}
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <i class="fas fa-calendar"></i>
                Fecha de entrada:
                {{Carbon\Carbon::create($currentInspection->contract->fechaEntrega)->format('d/m/Y h:m')}}
            </div>
        </div>
        <br>
        <div class="row text-center" style="background-color: #dcdcdc">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <strong>Accesorios</strong>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                    @foreach ($accessories as $accessory )
                        @if($currentInspection->checkinAccessories->contains($accessory))
                            <i class="fa-regular fa-square-check"></i> {{ $accessory->nomAccesorio }}
                        @else
                            <i class="fa-regular fa-square"></i> {{ $accessory->nomAccesorio }}
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <br>
        <div class="row text-center" style="background-color: #dcdcdc">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <strong>
                    Fotografías
                </strong>
            </div>
        </div>
        <br>
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                    @foreach ($currentInspection->photos as $photo)

                        @if($photo->etapa == 'checkin')

                            <img
                                id="photo"
                                alt="photo"
                                height="70px"
                                src="{{public_path($photo->foto)}}"
                            >

                        @endif

                    @endforeach
                </div>
            </div>
        </div>
        <br>
        <div class="row text-center" style="background-color: #dcdcdc">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                <strong>Notas Adicionales</strong>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                <strong>Firma del cliente</strong>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <i class="fas fa-clipboard"></i>
                Otras Observaciones: {{$currentInspection->otrasObservacionesEntrega}}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                @if($currentInspection->firmaClienteEntrega )
                    <img
                        height="70px"
                        width="300px"
                        src="{{public_path($currentInspection->firmaClienteEntrega)}}"
                    >

                @else
                    <p>Sin Registro</p>
                @endif


            </div>
        </div>

    @endif


</div>
<script src="{{asset('/assets/js/jquery-3.4.1.slim.min.js')}}"
></script>

<script src="{{asset('/assets/js/bootstrap/bootstrap.js')}}"
></script>
</body>

</html>
