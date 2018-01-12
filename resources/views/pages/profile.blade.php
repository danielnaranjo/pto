@extends('layouts.app')

@section('title', $titulo)

@section('content')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<!--Begin::Main Portlet-->
				<div class="row">
                    <div class="col-xl-3">
						<div class="m-portlet m-portlet--full-height  ">
							<div class="m-portlet__body">
								<div class="m-card-profile">
									<div class="m-card-profile__title m--hide">
										Mi Perfil
									</div>
									<div class="m-card-profile__pic">
										<div class="m-card-profile__pic-wrapper">
                                            @if($results->avatar)
                                                <img src="{{ $results->avatar }}" alt="{{$results->name}}">
                                            @else
			                                    <img src="/pic/avatar.png" alt="avatar">
                                            @endif
										</div>
									</div>
									<div class="m-card-profile__details">
										<span class="m-card-profile__name">
											{{$results->name}}
										</span>
 										Usuario desde {{ Date::parse($results->created_at)->format('F Y') }}
									</div>
								</div>
								<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
									<li class="m-nav__separator m-nav__separator--fit"></li>
									<li class="m-nav__section m--hide">
										<span class="m-nav__section-text">
											Section
										</span>
									</li>
									<!-- <li class="m-nav__item">
										<a href="#" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-profile-1"></i>
											<span class="m-nav__link-title">
												<span class="m-nav__link-wrap">
													<span class="m-nav__link-text">
														Mi Perfil
													</span>
												</span>
											</span>
										</a>
									</li> -->
                                    @if($results->verified==1)
                                    <li class="m-nav__item">
										<a href="#" class="m-nav__link">
											<i class="m-nav__link-icon fa fa-check-circle-o"></i>
											<span class="m-nav__link-text">
												Usuario verificado
											</span>
										</a>
									</li>
                                    @endif
                                    @if($results->address)
									<li class="m-nav__item">
										<a href="#" class="m-nav__link">
											<i class="m-nav__link-icon fa fa-globe"></i>
											<span class="m-nav__link-text">
												Ubicación verificada
											</span>
										</a>
									</li>
                                    @endif
									<li class="m-nav__item">
										<a href="#" class="m-nav__link">
											<i class="m-nav__link-icon fa fa-id-card-o"></i>
											<span class="m-nav__link-text">
												Documentación enviada
											</span>
                                            <span class="m-nav__link-badge">
                                                <span class="m-badge m-badge--success">
                                                    1
                                                </span>
                                            </span>
										</a>
									</li>
								</ul>
								<div class="m-portlet__body-separator"></div>

							</div>
						</div>
					</div>
					<div class="col-xl-6">
                        <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-tools">
									<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active" data-toggle="tab" href="#reputacion" role="tab">
												<i class="flaticon-share m--hide"></i>
												Mi Reputación
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link" data-toggle="tab" href="#envios" role="tab">
												Mis Envios
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="tab-content">
								<div class="tab-pane active" id="reputacion" style="padding:20px;">
                                    <!-- reputacion -->
                                    <div class="m-widget3">
                                        @forelse( $comments as $com )
    										<div class="m-widget3__item">
    											<div class="m-widget3__header">
    												<div class="m-widget3__user-img">
    													<!-- <img class="m-widget3__img" src="/assets/app/media/img/users/user1.jpg" alt=""> -->
                                                        @if($com->avatar)
                                                            <img src="{{$com->avatar}}" alt="{{$com->name}}" class="m-widget3__img">
                                                        @else
                                                            <img src="/pic/avatar.png" alt="avatar" class="m-widget3__img">
                                                        @endif
    												</div>
    												<div class="m-widget3__info">
    													<span class="m-widget3__username">
    														 {{ $com->from->name }}
    													</span>
    													<br>
    													<span class="m-widget3__time">

                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
    													</span>
    												</div>
    												<span class="m-widget3__status m--font-info">
                                                        {{ Date::parse($com->createdAt)->format('d/m/Y') }}
    												</span>
    											</div>
    											<div class="m-widget3__body">
    												<p class="m-widget3__text">
    													{{ $com->comment }}
    												</p>
    											</div>
    										</div>
                                        @empty
                                            <h5>No hay reputación disponible</h5>
                                        @endforelse
									</div>
                                    <!-- reputacion -->
								</div>
								<div class="tab-pane" id="envios" style="padding:20px;">
                                    <!-- timeline viajes -->
                                    <div class="m-widget5">
                                        @forelse( $packages as $pack )
    										<div class="m-widget5__item">
    											<div class="m-widget5__pic">
    												<img class="m-widget7__img" src="/assets/app/media/img/products/product6.jpg" alt="{{ $pack->title }}">
    											</div>
    											<div class="m-widget5__content">
    												<h4 class="m-widget5__title">
    													<a href="/package/{{ $pack->tracking }}">
                                                            {{ $pack->title }}
                                                        </a>
    												</h4>
    												<span class="m-widget5__desc">
    			                                        {{ $pack->description }}
    												</span>
    												<div class="m-widget5__info">
    													<!-- <span class="m-widget5__author">
    														Enviado:
    													</span> -->
    													<span class="m-widget5__info-label">
    														Tipo de envio:
    													</span>
    													<span class="m-widget5__info-author-name">
    														{{ $pack->service->type }}
    													</span>
                                                        @if($pack->status>0)
    													<span class="m-widget5__info-label">
    														Entregado
    													</span>
    													<span class="m-widget5__info-date m--font-info">
    														{{ Date::parse($pack->created)->format('d/m/Y H:i') }}
    													</span>
                                                        @endif
    												</div>
    											</div>
    											<div class="m-widget5__stats1">
    												<span class="m-widget5__number">
                                                        @if($pack->price>0)
        													{{ $divisa or '$' }}
                                                            {{ $pack->price }}
                                                        @else
                                                            Gratis
                                                        @endif
    												</span>
    												<br>
    												<span class="m-widget5__sales">
    													@if($pack->auction=='Y')
                                                            Ofertado
                                                        @else
                                                            @if($pack->price>0)
                                                                Monto fijo
                                                            @endif
                                                        @endif
    												</span>
    											</div>
    										</div>
                                        @empty
                                            <h5>No hay información de paquetes disponible</h5>
                                        @endforelse
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-xl-3">
                        <div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Próximos viajes
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
                                <!-- scroll -->
                                <div class="m-scrollable mCustomScrollbar _mCS_3 mCS-autoHide" data-scrollable="true" data-max-height="400" style="height: 400px; overflow: visible; max-height: 400px; position: relative;">
                                    <div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;">
                                        <div id="mCSB_3_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
                                            <!-- timeline viajes -->
                                            <div class="m-list-timeline m-list-timeline--skin-light">
                                                <div class="m-list-timeline__items">
                                                    @forelse( $travel as $t )
                                                    <div class="m-list-timeline__item">
                                                        <span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
                                                        <span class="m-list-timeline__text">
                                                            {{$t->title}}
                                                            @if($t->restrictions)
                                                            <span class="m-badge m-badge--info m-badge--wide">
                                                                Ciertas restricciones aplica
                                                            </span>
                                                            @endif
                                                            <br>Espacio: {{$t->dimensions}}
                                                        </span>
                                                        <span class="m-list-timeline__time">
                                                            {{ Date::parse($t->date)->format('d/m/Y') }}
                                                        </span>
                                                    </div>
                                                    @empty
                                                        <h5>No hay información de viajes</h5>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <!-- timeline viajes -->
                                        </div>
                                    </div>
                                </div>
                                <!-- scroll -->
							</div>
						</div>
                    </div>
                    <div class="col-xl-12">
                        <p>
                            <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="/travel">
                                Volver atras
                            </a>
                        </p>
                    </div>
				</div>
				<!--End::Main Portlet-->
			</div>
		</div>
	</div>
</div>
@endsection
