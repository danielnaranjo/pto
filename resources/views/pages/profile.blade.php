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
										<a href="#" class="m-card-profile__email m-link">
											{{$results[0]->address}}
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
								<div class="tab-pane active" id="reputacion">
                                    reputacion
								</div>
								<div class="tab-pane" id="envios">
								    envios
								</div>
                                <div class="tab-pane" id="viajes">
								    viajes
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
