<p>
	Hola {{ $usuario }}
</p>
<p>
	Has publicado en Paqueto, un viaje de <b>{{ $origen }}</b> a <b>{{ $destino }}</b> con el siguiente detalle:
</p>
<ul>
    <li>Fecha: {{ $fecha }}</li>
    <li>Peso: {{ $peso }}</li>
    <li>Dimensiones: {{ $dimensiones }}</li>
    <li>Restrinciones: {!! $restricciones !!}</li>
</ul>
<p>
	Recuerda no compartir datos personales <em>(email, teléfono, etc.)</em> hasta que hayas concretado un servicio de envio, verifica la información del paqueto viajero antes de continuar, tienes dudas? Contactanos y te ayudaremos.
</p>
<p>
	Saludos,
</p>
<p>
	<b>Daniel N.</b><br/>
	<a href="//www.paqueto.com.ve?utm_source=travel&utm_medium=mail" target="_blank">www.paqueto.com.ve</a>
</p>
<hr/>
<p>
	Este es un mensaje automatico de <a href="//www.paqueto.com.ve?utm_source=travel&utm_medium=mail" target="_blank">www.paqueto.com.ve</a>, enviado el {{ $fecha }}.
</p>