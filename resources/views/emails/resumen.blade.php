<p>Hola {{ $usuario }}</p>
<p>Te enviamos tus conversaciones en paqueto:</p>
<p>
    Últimos mensajes
</p>
<ul>
    @forelse($comentarios as $m)
    <li>A: <a href="/u/{{$m->from->slug}}">{{ $m->from->name }}</a>, le enviaste: {!! $m->comment !!}</li>
    @empty
    <li>No tienes mensajes</li>
    @endforelse
</ul>
<p>Recuerda no compartir datos personales (email, telefono, etc.)  hasta que hayas concretado un servicio de envio, verifica la informacion del paqueto viajero antes de continuar.</p>
<p>Saludos,</p>
<p>Daniel @ Paqueto</p>
