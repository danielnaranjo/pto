@extends('layouts.app')

@section('title', $titulo)

@section('content')

<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
                <!--Begin::Main Portlet-->
                <div class="row">
                    <div class="col-xl-12">
                        <!--begin:: Widgets/Application Sales-->
                        <div class="m-portlet m-portlet--full-height ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            {{ $titulo }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="nav nav-pills nav-pills--info m-nav-pills--align-right m-nav-pills--btn-pill">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active" href="/travel/create">
												Agregar mi viaje
											</a>
										</li>
									</ul>
								</div>
                            </div>
                        </div>
                        <!--end:: Widgets/Application Sales-->
                    </div>
                </div>
                <!--End::Main Portlet-->
				<!--Begin::Main Portlet-->
				<div class="row">
                    @forelse ($results as $result)
                    <div class="col-xl-3" id="{{ $result->code }}">
                        <!--begin:: Widgets/Announcements 1-->
                        <!-- style="background-image:url('/assets/app/media/img/products/product4.jpg');background-repeat:cover;" -->
                        <div class="m-portlet m--bg-accent m-portlet--bordered-semi m-portlet--full-height m-portlet--skin-dark">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            {{ $result->country }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <!--begin::Widget 7-->
                                <div class="m-widget7 m-widget7--skin-dark">
                                    <div class="m-widget7__desc">
                                        {{ $result->viajeros }}
                                        @if($result->viajeros>1)
                                            viajeros
                                        @else
                                            viajero
                                        @endif
                                    </div>
                                    <div class="m-widget7__user">
                                        <div class="m-widget7__user-img">
                                            <a href="/u/{{ $result->slug }}">
                                                <!-- <img class="m-widget7__img" src="/assets/app/media/img/users/100_3.jpg" alt="{{ $result->name }}"> -->
                                                @if($result->avatar)
                                                    <img src="{{$result->avatar}}" alt="{{$result->name}}" class="m-widget7__img" >
                                                @else
                                                    <img src="/pic/avatar.png" alt="avatar" class="m-widget7__img" >
                                                @endif
                                            </a>
                                        </div>
                                        <div class="m-widget7__info">
                                            <span class="m-widget7__username">
                                                {{ $result->name }}
                                            </span>
                                            <br>
                                            <span class="m-widget7__time">
                                                {{ Date::parse($result->date)->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="m-widget7__button">
                                        <a class="m-btn m-btn--pill btn btn-info" href="/explorar/{{ str_slug($result->country,'-') }}/{{ $result->destination }}" role="button">
                                            Explorar
                                        </a>
                                    </div>
                                </div>
                                <!--end::Widget 7-->
                            </div>
                        </div>
                        <!--end:: Widgets/Announcements 1-->
                    </div>
                    @empty
                    <div class="col-xl-3">
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Lo sentimos
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                No hay viajeros disponibles
                            </div>
                        </div>
                    </div>
                    @endforelse
				</div>
				<!--End::Main Portlet-->
                <div class="col-xl-12">
                    {{ $results->links() }}
                </div>
			</div>
		</div>
	</div>
</div>

@endsection
