<p>
	Hola <b>{{ $nombre or '' }}</b>
</p>
<p>
	Tu amigo {{ $usuario or '' }} te ha recomendado nuestro servicio de envios: Paqueto. Nuestra principal fortaleza es ofrecer envios y viajeros verificados de forma segura.
</p>
<p> </p>
<p>
	Tienes dudas sobre Paqueto? Responde este email, sin embargo, te adelanto algunos terminos que encontraras en nuestra sitio:
</p>
<ul>
    <li><b>Paqueto Envio:</b> son aquellas cosas que estan pendientes de ser entregados en algún lugar del mundo, desde tu punto de partida o tu proximo destino.</li>
    <li><b>Paqueto Viajero:</b> este eres tú, el que publica su información de viaje y quiere ser contactado para que transporte alguna encomienda.</li>
</ul>

<p>
	Saludos cordiales,
</p>
<p>
	<b>Diego N.</b><br>
	<a href="//www.paqueto.com.ve?utm_source=referidos&utm_medium=mail" target="_blank">www.paqueto.com.ve</a>
</p>
<hr/>
<p>
	Este es un mensaje automatico fue enviado a <a href="mailto:{{ $email }}">{{ $email }}</a> porque te registraste en <a href="//www.paqueto.com.ve?utm_source=referidos&utm_medium=mail" target="_blank">www.paqueto.com.ve</a> el {{ $fecha }}.
</p>
