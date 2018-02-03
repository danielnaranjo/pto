<h4>Actividad diaria: {{ $fecha }}</h4>

<p>
    Últimos comentarios
</p>
<ul>
    @foreach ($comentarios as $comentario)
    <li>{!! $comentario->comment !!}</li>
    @endforeach
</ul>
<p>
    Últimos mensajes
</p>
<ul>
    @foreach ($mensajes as $mensaje)
    <li>{!! $mensaje->comment !!}</li>
    @endforeach
</ul>

<p>
    Últimos paquetes
</p>
<ul>
    @foreach ($paquetes as $paquete)
    <li>{!! $paquete->title !!}</li>
    @endforeach
</ul>

<p>
    Últimos usuarios
</p>
<ul>
    @foreach ($usuarios as $usuario)
    <li>{!! $usuario->name !!}</li>
    @endforeach
</ul>

<p>
    Últimos viajes
</p>
<ul>
    @foreach ($viajeros as $viajero)
    <li>{!! $viajero->title !!}</li>
    @endforeach
</ul>
