<h4>Hay {{ count($imagenes) }} imagenes del dia: {{ $fecha }}</h4>
<ul>
    @forelse ($imagenes as $image)
    <li>
        URL: <a href="{{ $image->path }}">{{ $image->name }}</a> ID: {{ $image->image_id }}  Hora: {{ $image->created }}
    </li>
    @empty
    <li>No hay imagenes disponibles</li>
    @endforelse
</ul>
