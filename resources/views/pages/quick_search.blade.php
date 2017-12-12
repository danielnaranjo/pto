<div class="m-list-search__results">

    <span class="m-list-search__result-category">
		Propietarios
	</span>
    @forelse ($propietarios as $propietario)
	<a href="/propietarios/{{ $propietario->pro_id }}/edit" class="m-list-search__result-item">
		<span class="m-list-search__result-item-icon"><i class="fa fa-address-card-o m--font-warning"></i></span>
		<span class="m-list-search__result-item-text">{{ $propietario->pro_nombre }} {{ $propietario->pro_apellido }}</span>
	</a>
    @empty
    <a href="#" class="m-list-search__result-item">
        <span class="m-list-search__result-item-icon"><i class="fa fa-times  m--font-danger"></i></span>
        <span class="m-list-search__result-item-text">No hay resultados</span>
    </a>
    @endforelse

    <span class="m-list-search__result-category">
		Consorcios
	</span>
    @forelse ($consorcios as $consorcio)
        {{-- solo se muestra a su inmobiliaria --}}
    	<a href="/consorcios/{{ $consorcio->con_id }}/edit" class="m-list-search__result-item">
    		<span class="m-list-search__result-item-icon"><i class="fa fa-building-o  m--font-warning"></i></span>
    		<span class="m-list-search__result-item-text"> {{ $consorcio->con_nombre }}</span>
    	</a>
    @empty
    <a href="#" class="m-list-search__result-item">
        <span class="m-list-search__result-item-icon"><i class="fa fa-times m--font-danger"></i></span>
        <span class="m-list-search__result-item-text">No hay resultados</span>
    </a>
    @endforelse

    @if(Session::has('administrador'))
    <span class="m-list-search__result-category">
        Administradores
    </span>
    @forelse ($inmobiliarias as $inmobiliaria)
    <a href="/inmobiliarias/{{ $inmobiliaria->inm_id }}/edit" class="m-list-search__result-item">
        <span class="m-list-search__result-item-icon"><i class="fa fa-user-circle-o m--font-warning"></i></span>
        <span class="m-list-search__result-item-text">{{ $inmobiliaria->inm_nombre }}</span>
    </a>
    @empty
    <a href="#" class="m-list-search__result-item">
        <span class="m-list-search__result-item-icon"><i class="fa fa-times  m--font-danger"></i></span>
        <span class="m-list-search__result-item-text">No hay resultados</span>
    </a>
    @endforelse
    @endif

    <p class="pull-right" style="padding-left:70%">
        <a href="https://www.algolia.com/?utm_source=tuconsorcio.com.ar" target="_new">
            <img src="/img/search-by-algolia.png" alt="powered by algolia" style="width:100%">
        </a>
	</p>
</div>
