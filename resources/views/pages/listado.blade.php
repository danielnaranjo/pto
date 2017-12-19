@extends('layouts.app')

@section('title', $titulo)

@section('content')

<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<!--Begin::Main Portlet-->
				<div class="row">
                    @forelse ($results as $result)
                    <div class="col-xl-3">
                        <div class="m-widget4">
                            <!--begin::Widget 14 Item-->
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--pic">
                                    <img src="assets/app/media/img/users/100_4.jpg" alt="">
                                </div>
                                <div class="m-widget4__info">
                                    <span class="m-widget4__title">
                                        {{$result->name}}
                                    </span>
                                    <br>
                                    <span class="m-widget4__sub">
                                        Capital Federal
                                    </span>
                                </div>
                                <div class="m-widget4__ext">
                                    <a href="/user/{{$result->id}}" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
                                        Seguir
                                    </a>
                                </div>
                            </div>
                            <!--end::Widget 14 Item-->
                        </div>
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
			</div>
		</div>
	</div>
</div>

@endsection
