<p>
	Hola {{ $usuario }},
</p>
<p>
	Has publicado en Paqueto, un paquete de <b>{{ $origen }}</b> a <b>{{ $destino }}</b> con el siguiente detalle:
</p>
<ul>
    <li>Tipo de envio: <b>{{ $servicio }}</b></li>
    <li>Fecha estimada de entrega: <b>{{ $entrega }}</b></li>
    <li>Tracking: <a href="//www.paqueto.com.ve/package/{{ $tracking }}?utm_source=package&utm_medium=mail" target="_blank"><b>{{ $tracking }}</b></a></li>
    <li>Contenido del paquete: {!! $contenido !!}</li>
</ul>
<p>
	Recuerda no compartir datos personales <em>(email, teléfono, etc.)</em> hasta que hayas concretado un servicio de envio, verifica la información del paqueto viajero antes de continuar, tienes dudas? Contactanos y te ayudaremos.
</p>
<p>
	Saludos,
</p>
<p>
	Daniel N.<br/>
	<a href="//www.paqueto.com.ve?utm_source=package&utm_medium=mail" target="_blank">www.paqueto.com.ve</a>
</p>
<hr/>
<p>
	Este es un mensaje automatico de <a href="//www.paqueto.com.ve?utm_source=package&utm_medium=mail" target="_blank">www.paqueto.com.ve</a>, enviado el {{ $fecha }}.
</p>
