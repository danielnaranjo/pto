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
<div class="m-list-timeline__items">
	<div class="m-list-timeline__item">
		<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
		<span class="m-list-timeline__text">
			12 new users registered
		</span>
		<span class="m-list-timeline__time">
			Just now
		</span>
	</div>
	<div class="m-list-timeline__item">
		<span class="m-list-timeline__badge"></span>
		<span class="m-list-timeline__text">
			System shutdown
			<span class="m-badge m-badge--success m-badge--wide">
				pending
			</span>
		</span>
		<span class="m-list-timeline__time">
			14 mins
		</span>
	</div>
	<div class="m-list-timeline__item">
		<span class="m-list-timeline__badge"></span>
		<span class="m-list-timeline__text">
			New invoice received
		</span>
		<span class="m-list-timeline__time">
			20 mins
		</span>
	</div>
	<div class="m-list-timeline__item">
		<span class="m-list-timeline__badge"></span>
		<span class="m-list-timeline__text">
			DB overloaded 80%
			<span class="m-badge m-badge--info m-badge--wide">
				settled
			</span>
		</span>
		<span class="m-list-timeline__time">
			1 hr
		</span>
	</div>
</div>
