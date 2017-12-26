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
											<img src="../assets/app/media/img/users/user4.jpg" alt="">
										</div>
									</div>
									<div class="m-card-profile__details">
										<span class="m-card-profile__name">
											{{$results[0]->name}}
										</span>
 											{{$results[0]->info->city}}
										</a>
									</div>
								</div>
								<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
									<li class="m-nav__separator m-nav__separator--fit"></li>
									<li class="m-nav__section m--hide">
										<span class="m-nav__section-text">
											Section
										</span>
									</li>
									<li class="m-nav__item">
										<a href="../header/profile&amp;demo=default.html" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-profile-1"></i>
											<span class="m-nav__link-title">
												<span class="m-nav__link-wrap">
													<span class="m-nav__link-text">
														Mi Perfil
													</span>
												</span>
											</span>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="../header/profile&amp;demo=default.html" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-share"></i>
											<span class="m-nav__link-text">
												Actividad
											</span>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="../header/profile&amp;demo=default.html" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-chat-1"></i>
											<span class="m-nav__link-text">
												Mensajes
											</span>
                                            <span class="m-nav__link-badge">
                                                <span class="m-badge m-badge--success">
                                                    2
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
												Reputación
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link" data-toggle="tab" href="#envios" role="tab">
												Envios
											</a>
										</li>
                                        <li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link" data-toggle="tab" href="#viajes" role="tab">
												Viajes
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="tab-content">
								<div class="tab-pane active" id="reputacion" style="padding:20px;">
                                    <!-- reputacion -->
                                    <div class="m-widget3">
                                        @foreach( $results[0]->comment as $comentario )
										<div class="m-widget3__item">
											<div class="m-widget3__header">
												<div class="m-widget3__user-img">
													<img class="m-widget3__img" src="/assets/app/media/img/users/user1.jpg" alt="">
												</div>
												<div class="m-widget3__info">
													<span class="m-widget3__username">
														Melania Trump {{$comentario}}
													</span>
													<br>
													<span class="m-widget3__time">
														{{--$comentario->createdAt--}}
													</span>
												</div>
												<span class="m-widget3__status m--font-info">
													Pending
												</span>
											</div>
											<div class="m-widget3__body">
												<p class="m-widget3__text">
													{{--$comentario->comment--}}
												</p>
											</div>
										</div>
                                            <!-- <h5>No hay información disponible</h5> -->
                                        @endforeach
									</div>
                                    <!-- reputacion -->
								</div>
								<div class="tab-pane" id="envios" style="padding:20px;">
                                    <!-- timeline viajes -->
                                    <div class="m-widget5">
                                        @foreach( $results[0]->package as $pack )
										<div class="m-widget5__item">
											<div class="m-widget5__pic">
												<img class="m-widget7__img" src="/assets/app/media/img/products/product6.jpg" alt="">
											</div>
											<div class="m-widget5__content">
												<h4 class="m-widget5__title">
													{{ $pack}}
												</h4>
												<span class="m-widget5__desc">
			                                        {{--$pack->description--}}
												</span>
												<div class="m-widget5__info">
													<span class="m-widget5__author">
														Enviado:
													</span>
													<span class="m-widget5__info-label">
														author:
													</span>
													<span class="m-widget5__info-author-name">
														{{--$pack->service->type--}}
													</span>
													<span class="m-widget5__info-label">
														Entregado
													</span>
													<span class="m-widget5__info-date m--font-info">
														{{--$pack->created--}}
													</span>
												</div>
											</div>
											<div class="m-widget5__stats1">
												<span class="m-widget5__number">
													{{--$pack->price--}}
												</span>
												<br>
												<span class="m-widget5__sales">
													Monto
												</span>
											</div>
										</div>
                                            <!-- <h5>No hay información disponible</h5> -->
                                        @endforeach
									</div>
								</div>
                                <div class="tab-pane" id="viajes" style="padding:20px;">
                                    <!-- timeline viajes -->
                                    <div class="m-list-timeline m-list-timeline--skin-light">
										<div class="m-list-timeline__items">
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
												<span class="m-list-timeline__text">
													12 new users registered
												</span>
												<span class="m-list-timeline__time">
													Just now
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
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
												<span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
												<span class="m-list-timeline__text">
													New invoice received
												</span>
												<span class="m-list-timeline__time">
													20 mins
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--accent"></span>
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
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--warning"></span>
												<span class="m-list-timeline__text">
													System error -
													<a href="#" class="m-link">
														Check
													</a>
												</span>
												<span class="m-list-timeline__time">
													2 hrs
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--brand"></span>
												<span class="m-list-timeline__text">
													Production server down
												</span>
												<span class="m-list-timeline__time">
													3 hrs
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
												<span class="m-list-timeline__text">
													Production server up
												</span>
												<span class="m-list-timeline__time">
													5 hrs
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
												<span href="" class="m-list-timeline__text">
													New order received
													<span class="m-badge m-badge--danger m-badge--wide">
														urgent
													</span>
												</span>
												<span class="m-list-timeline__time">
													7 hrs
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
												<span class="m-list-timeline__text">
													12 new users registered
												</span>
												<span class="m-list-timeline__time">
													Just now
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
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
												<span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
												<span class="m-list-timeline__text">
													New invoice received
												</span>
												<span class="m-list-timeline__time">
													20 mins
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--accent"></span>
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
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
												<span class="m-list-timeline__text">
													New invoice received
												</span>
												<span class="m-list-timeline__time">
													20 mins
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--accent"></span>
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
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--warning"></span>
												<span class="m-list-timeline__text">
													System error -
													<a href="#" class="m-link">
														Check
													</a>
												</span>
												<span class="m-list-timeline__time">
													2 hrs
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--brand"></span>
												<span class="m-list-timeline__text">
													Production server down
												</span>
												<span class="m-list-timeline__time">
													3 hrs
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
												<span class="m-list-timeline__text">
													Production server up
												</span>
												<span class="m-list-timeline__time">
													5 hrs
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
												<span href="" class="m-list-timeline__text">
													New order received
													<span class="m-badge m-badge--danger m-badge--wide">
														urgent
													</span>
												</span>
												<span class="m-list-timeline__time">
													7 hrs
												</span>
											</div>
										</div>
									</div>
                                    <!-- timeline viajes -->
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
											Información
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								aqui
                                {{$results[0]->info->city}}
							</div>
						</div>
                    </div>
                    <div class="col-xl-12">
                        <p>
                            <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="{{ url()->previous() }}">
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
