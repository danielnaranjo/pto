    <!-- <p>
        Estimado Propietario de <strong>{{ $con_nombre }}</strong>
    </p> -->
    <p>
        Por medio del presente mail le enviamos la información necesaria para poder acceder a nuestro sistema de consorcios on line y ver los detalles de sus expensas, avisos importantes y calendario del mes.
    </p>
    <p>
        Para ingresar a <a href="http://www.tuconsorcio.com.ar/?ref={{ $con_nombre }}">www.tuconsorcio.com.ar</a></p>
    <p>
        Su usuario: <strong>{{ $con_usuario }}</strong><br/>
        Su password: <strong>{{ $con_password }}</strong>
    </p>
    <p>
        Cualquier duda o consulta respecto al funcionamiento del sistema, estamos a su disposición.
    </p>
    <p>
        {!! $inm_firma !!}
    </p>
