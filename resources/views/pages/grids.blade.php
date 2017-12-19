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
                        <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
							<div class="m-portlet__head m-portlet__head--fit">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-action">
										<button type="button" class="btn btn-sm m-btn--pill">
											Categoria
										</button>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="m-widget19">
									<div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
										<img src="assets/app/media/img//blog/blog1.jpg" alt="">
										<h3 class="m-widget19__title m--font-light">
											{{$result->title}}
										</h3>
										<div class="m-widget19__shadow"></div>
									</div>
									<div class="m-widget19__content">
										<div class="m-widget19__header">
											<div class="m-widget19__user-img">
												<img class="m-widget19__img" src="assets/app/media/img//users/user1.jpg" alt="">
											</div>
											<div class="m-widget19__info">
												<span class="m-widget19__username">
													Carol Carvajal
												</span>
												<br>
												<span class="m-widget19__time">
													Buenos Aires, Argentina
												</span>
											</div>
											<div class="m-widget19__stats">
												<span class="m-widget19__number m--font-brand">
													18
												</span>
												<span class="m-widget19__comment">
													Comentarios
												</span>
											</div>
										</div>
										<div class="m-widget19__body">
											{{$result->description}}
										</div>
									</div>
									<div class="m-widget19__action">
										<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">
											Contactar
										</button>
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
