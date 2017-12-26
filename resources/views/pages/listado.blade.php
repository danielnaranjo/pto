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

                            <div class="m-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon">
													<i class="flaticon-map-location"></i>
												</span>
												<h3 class="m-portlet__head-text">
													{{$result->address}}
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<!-- <li class="m-portlet__nav-item">
													<a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
														<i class="la la-close"></i>
													</a>
												</li> -->
												<!-- <li class="m-portlet__nav-item">
													<a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
														<i class="la la-refresh"></i>
													</a>
												</li> -->
												<!-- <li class="m-portlet__nav-item">
													<a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
														<i class="la la-circle"></i>
													</a>
												</li> -->
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--pic">
                                                <a href="/user/{{$result->id}}">
                                                    <img src="assets/app/media/img/users/100_4.jpg" alt="{{$result->name}}">
                                                </a>
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    {{$result->name}}
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{$result->address}}
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
