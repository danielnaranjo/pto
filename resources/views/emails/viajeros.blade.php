<p>Hola {{ $usuario }}</p>
<p>Hemos encontrado algunos viajeros que va hacia {{ $destino }} con el siguiente detalle:</p>
<ul>
    @forelse($travel as $t)
    <li>
        {{ $t->user->name }} viaja desde {{ $t->from->name }} el dia {{ $t->fecha }}, con {{ $t->peso }} disponible o {{ $t->dimensiones }} de espacio/volumen, pero no lleva los siguientes articulos {!! $t->restrinciones !!}
    </li>
    @empty
    <li>No hay información disponible</li>
    @endforelse
</ul>
<p>Recuerda no compartir datos personales (email, telefono, etc.) hasta que hayas concretado un servicio de envio, verifica la informacion del paqueto viajero antes de continuar.</p>
<p>Saludos,</p>
<p>Daniel @ Paqueto</p>
