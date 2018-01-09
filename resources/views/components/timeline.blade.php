@forelse ($mensajes as $mensaje)
    <div class="m-list-timeline__item">
        <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
        <span class="m-list-timeline__text">
            <a href="/mensajes/{{$mensaje->$message_id}}">
                {{ $mensaje->comment }}
            </a><br>
            <small>{{ $mensaje->con_nombre }}</small>
        </span>
        <span class="m-list-timeline__time">
            {{ Date::parse($mensaje->createdAt)->format('d/m/Y') }}
        </span>
    </div>
@empty
    <div class="m-list-timeline__item">
        <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
        <span class="m-list-timeline__text">
            No tienes mensajes
        </span>
        <span class="m-list-timeline__time">
            {{ Date::now()->format('d/m/Y') }}
        </span>
    </div>
@endforelse
