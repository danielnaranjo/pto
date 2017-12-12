@if(Session::has('comments'))
    @forelse (Session::get('comments') as $comment)
    <div class="m-list-timeline__item">
        <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
        <span class="m-list-timeline__text">
            <a href="/comentarios/{{$comment->com_id}}">
                {{ $comment->com_propietario }}
            </a><br>
            <small>{{ $comment->con_nombre }}</small>
        </span>
        <span class="m-list-timeline__time">
            {{ Carbon\Carbon::parse($comment->com_fecha)->format('d/m/Y') }}
        </span>
    </div>
    @empty
    <div class="m-list-timeline__item">
        <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
        <span class="m-list-timeline__text">
            No hay consultas realizadas
        </span>
        <span class="m-list-timeline__time">
            Ahora
        </span>
    </div>
    @endforelse
@endif
