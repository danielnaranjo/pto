<h4>Hay {{ count($imagenes) }} imagenes del dia: {{ $fecha }}</h4>
@forelse ($imagenes as $image)
<p>
    <a href="{{ $image->path }}">
        <img src="{{ $image->path }}" alt="{{ $image->name }}" width="200" />
    </a><br>
    ID: {{ $image->image_id }}<br>
    Hora: {{ $image->created }}
</p>
@empty
<h5>No hay imagenes disponibles</h5>
@endforelse
