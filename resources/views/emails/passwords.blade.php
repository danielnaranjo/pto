<p>
	Hola <b>{{ $nombre }}</b>
</p>
<p>
	Gracias por registrarte, recuerda completar todos tus datos antes de continuar. Nuestra principal fortaleza es ofrecer envios y viajeros verificados de forma segura.
</p>
<p>
	Usuario: <b>{{ $email }}</b><br>
	Contraseña: <b>{{ $password }}</b> <br>
	URL personalizada: <a href="//www.paqueto.com.ve/u/{{ $slug }}?utm_source=welcome&utm_medium=mail" target="_blank">
		<b>www.paqueto.com.ve/u/{{ $slug }}</b>
		</a>
</p>
<p>
	Tienes dudas sobre Paqueto? Responde este email, sin embargo, te adelanto algunos terminos que encontraras en nuestra sitio:
</p>
<ul>
    <li>Paqueto Envio: son aquellas cosas que estan pendientes de ser entregados en algún lugar del mundo, desde tu punto de partida o tu proximo destino.</li>
    <li>Paqueto Viajero: este eres tú, el que publica su información de viaje y quiere ser contactado para que transporte alguna encomienda.</li>
</ul>
<p>
	Saludos,
</p>
<p>
	<b>Diego @ Paqueto</b>
</p>
<hr/>
<p>
	Este es un mensaje automatico fue enviado a <a href="mailto:{{ $email }}">{{ $email }}</a> porque te registraste en <a href="//www.paqueto.com.ve?utm_source=welcome&utm_medium=mail" target="_blank">www.paqueto.com.ve</a> el {{ $fecha }}.
</p>