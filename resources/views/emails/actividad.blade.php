
<h4>Actividad diaria: {{ $fecha }}</h4>

<p>
    Últimos comentarios
</p>
<ul>
    @forelse ($comentarios as $comentario)
    <li><a href="/u/{!! $comentario->from['slug']or 'NA'  !!}">{!! $comentario->from['name'] !!}</a> le dijo: {!! $comentario->comment !!}, a: <a href="/u/{!! $comentario->user['slug']or 'NA'  !!}">{!! $comentario->user['name'] !!}</a></li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>
<p>
    Últimos mensajes
</p>
<ul>
    @forelse ($mensajes as $mensaje)
    <li><a href="/u/{!! $mensaje->from['slug']or 'NA'  !!}">{!! $mensaje->from['name'] !!}</a> le dijo: {!! $mensaje->comment !!} a: <a href="/u/{!! $mensaje->user['slug']or 'NA'  !!}">{!! $mensaje->user['name'] !!}</a></li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>

<p>
    Últimos paquetes
</p>
<ul>
    @forelse ($paquetes as $paquete)
    <li>{!! $paquete->from->code !!} > {!! $paquete->to->code !!}: [{!! $paquete->service->type !!}] {!! $paquete->title !!} <a href="//mi.paqueto.com.ve/{!! $paquete->tracking !!}">Link</a></li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>

<p>
    Últimos usuarios
</p>
<ul>
    @forelse ($usuarios as $usuario)
    <li>{!! $usuario->name !!} E-mail: {!! $usuario->email !!} <a href="//mi.paqueto.com.ve/u/{!! $usuario->slug or 'NA' !!}">Link</a></li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>

<p>
    Últimos viajes
</p>
<ul>
    @forelse ($viajeros as $viajero)
    <li>{!! $viajero->from->code !!} > {!! $viajero->to->code !!}: {!! $viajero->title !!}. <a href="/u/{!! $viajero->user->slug !!}">{!! $viajero->user->name !!}</a></li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>
