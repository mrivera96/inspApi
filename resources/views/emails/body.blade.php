<p>Estimado/a {{$client_name  }}</p>
<p>Esperamos que esté teniendo un excelente día. Compartimos inspección de su vehículo alquilado con los siguientes
    detalles:
</p>


<p>
    <strong>No. de Inspección:</strong> {{$currentInspection["numInspeccion"]}} <br>
    <strong>Tipo de Inspección:</strong> {{$tipoInspeccion}} <br>
    <strong>Número de Contrato:</strong> {{$currentInspection["contract"]["numContrato"]}} <br>
    <strong>Vehículo:</strong> {{$currentInspection["car"]["nemVehiculo"]. ', '. $currentInspection["car"]["model"]["brand"]["descMarca"].' '. $currentInspection["car"]["modelo"].', '. $currentInspection["car"]["color"].', '. $currentInspection["car"]["numMatricula"]}}
    <br>
    <strong>Realizada por:</strong> {{$currentInspection["checkoutAgent"]["nomUsuario"]}} <br>

</p>
<p>
    Si tiene alguna pregunta o necesita más información, no dude en ponerse en contacto con nosotros. <br>

    Gracias por confiar en XPLORE RENT A CAR.
</p>
