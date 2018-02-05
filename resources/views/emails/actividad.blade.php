<h4>Actividad diaria: {{ $fecha }}</h4>

<p>
    Últimos comentarios
</p>
<ul>
    @forelse ($comentarios as $comentario)
    <li>{!! $comentario->comment !!}</li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>
<p>
    Últimos mensajes
</p>
<ul>
    @forelse ($mensajes as $mensaje)
    <li>{!! $mensaje->comment !!}</li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>

<p>
    Últimos paquetes
</p>
<ul>
    @forelse ($paquetes as $paquete)
    <li>{!! $paquete->title !!}</li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>

<p>
    Últimos usuarios
</p>
<ul>
    @forelse ($usuarios as $usuario)
    <li>{!! $usuario->name !!}</li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>

<p>
    Últimos viajes
</p>
<ul>
    @forelse ($viajeros as $viajero)
    <li>{!! $viajero->title !!}</li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>
