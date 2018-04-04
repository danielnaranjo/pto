<p>Hola {{ $usuario }}</p>
<p>Hemos encontrado algunos viajeros que va hacia {{ $destino }} con el siguiente detalle:</p>
<ul>
    @forelse($viajeros as $t)
    <li>
        <a href="//paqueto.com.ve/u/{{ $t->user->slug }}">{{ $t->user->name }}</a> viaja desde {{ $t->from->name }}, el día {{ Date::parse($t->date)->format('d/m/Y') }}, con {{ $t->weight }} kgs disponibles ó {{ $t->dimensions }} de espacio/volumen.
    </li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>
<p>Recuerda no compartir datos personales (email, teléfono, etc.) hasta que hayas concretado un servicio de envio, verifica la informacion del paqueto viajero antes de continuar.</p>
<p>Saludos,</p>
<p>Daniel @ Paqueto</p>
