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
                                            Usuarios verificados
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
									<!-- <ul class="nav nav-pills nav-pills--success m-nav-pills--align-right m-nav-pills--btn-pill">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active">
												Publicar
											</a>
										</li>
									</ul> -->
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
													{{$result->city}} {{$result->country}}
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
                                                <a href="/u/{{$result->user->slug}}">
                                                    <img src="assets/app/media/img/users/100_4.jpg" alt="{{$result->name}}">
                                                </a>
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    {{$result->name}}
                                                </span>
                                                <br>
                                                @if($result->verified==1)
                                                <span class="m-widget4__sub">
                                                    Usuario verificado
                                                    <i class="fa fa-check"></i>
                                                </span>
                                                <br>
                                                @endif
                                                @if($result->verified==1)
                                                <span class="m-widget4__sub">
                                                    <!-- Reputación:  -->
                                                    <i class="fa fa-thumbs-o-up"></i>
                                                    {{$result->upvotes}}
                                                </span>
                                                @endif
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
                <div class="col-xl-12">
                    {{ $results->links() }}
                    <!-- <p>
                        <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="{{ url()->previous() }}">
                            Volver atras
                        </a>
                    </p> -->
                </div>
			</div>
		</div>
	</div>
</div>

@endsection
