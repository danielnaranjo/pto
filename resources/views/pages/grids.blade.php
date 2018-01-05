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
                                            Consigue lo que sea del mundo por un viajero de forma segura
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
									<ul class="nav nav-pills nav-pills--info m-nav-pills--align-right m-nav-pills--btn-pill">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active" href="/package/create">
												Crear un Paqueto Envio
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
                    <div class="col-xl-3">
                        <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
							<div class="m-portlet__head m-portlet__head--fit">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-action">
										<a class="btn btn-sm m-btn--pill" href="/ver/{{ strtolower($result->service->type ) }}">
											{{ $result->service->type }}
										</a>
									</div>
								</div>
                                @if($result->user_id==Auth::user()->id)
                                <div class="m-portlet__head-tools">
									<ul class="m-portlet__nav">
										<li class="m-portlet__nav-item">
											<a href="/package/{{$result->package_id}}/edit" class="m-portlet__nav-link">
												<i class="fa fa-pencil"></i>
											</a>
										</li>
                                        <li class="m-portlet__nav-item">
											<a href="javascript:borrar('package',{{$result->package_id}})" class="m-portlet__nav-link">
												<i class="fa fa-trash"></i>
											</a>
										</li>
									</ul>
								</div>
                                @endif
							</div>
							<div class="m-portlet__body">
								<div class="m-widget19">
									<div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
                                        <img src="/assets/app/media/img/blog/blog1.jpg" alt="{{$result->title}}">
										<h3 class="m-widget19__title m--font-light">
											{{ $result->title }}
										</h3>
										<div class="m-widget19__shadow"></div>
									</div>
									<div class="m-widget19__content">
										<div class="m-widget19__header">
											<div class="m-widget19__user-img">
                                                <a href="/u/{{$result->user->slug}}">
                                                    <img class="m-widget19__img" src="/assets/app/media/img/users/user1.jpg" alt="{{$result->user->name}}">
                                                </a>
											</div>
											<div class="m-widget19__info">
												<span class="m-widget19__username">
													{{ $result->user->name }}
												</span>
												<br>
												<span class="m-widget19__time">
													{{ $result->user->address }}
												</span>
											</div>
											<div class="m-widget19__stats">
												<span class="m-widget19__number m--font-brand">
													{{ $result->from->code }}
												</span>
												<span class="m-widget19__comment">
													{{ $result->to->code }}
												</span>
											</div>
										</div>
										<div class="m-widget19__body">
											{{$result->description}}
										</div>
									</div>
									<div class="m-widget19__action">
                                        <a href="/package/{{$result->tracking}}">Ver más</a>
                                        @if($result->user_id==Auth::user()->id)
                                        [
                                            <a href="/package/{{$result->package_id}}/edit">
                                                Editar
                                            </a>
    										<a href="javascript:borrar('package',{{$result->package_id}})">
                                                Borrar
                                            </a>
                                        ]
                                        @endif
									</div>
								</div>
							</div>
						</div>
                    </div>
                    @empty
                    <div class="col-xl-4">
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
                                No hay paquetes disponibles
                            </div>
                        </div>
                    </div>
                    @endforelse

                    <div class="col-xl-12">
                        {{ $results->links() }}
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
