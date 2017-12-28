@extends('layouts.app')

@section('title', $titulo)

@section('content')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<!--Begin::Main Portlet-->
				<div class="row">
					<div class="col-xl-7">
						<!--begin:: Widgets/Application Sales-->
						<div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Envio de {{ $results->from->name }} a {{ $results->to->name }}
                                            @if($results->user_id==Auth::user()->id)
                                            [
                                                <a href="/package/{{$results->package_id}}/edit">
                                                    Editar
                                                </a>
        										<a href="javascript:borrar('package',{{$results->package_id}})">
                                                    Borrar
                                                </a>
                                            ]
                                            @endif
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<!-- <div class="tab-content"> -->
								<!--begin::Widget 11-->
								<div class="m-widget6">
                                    <h5>{{ $results->title }}</h5>
                                    <p>
                                        El paquete contiene: {{ $results->description }}
                                    </p>
                                    <p>
                                        Fecha prevista de entrega
                                        <strong>
                                        {{ Date::parse($results->delivery)->diffForHumans() }}
                                        </strong>
                                        ({{ Date::parse($results->delivery)->format('d/m/Y H:i') }})
                                    </p>
								</div>
								<!--end::Widget 11-->
								<!-- </div> -->
							</div>
						</div>
						<!--end:: Widgets/Application Sales-->
					</div>
                    <div class="col-xl-5">
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
								<!-- <div class="tab-content"> -->
									<!--begin::Widget 11-->
									<div class="m-widget6">
                                        <h5>Sobre el anunciante</h5>
										<p>
                                            Publicado por: <a href="/user/{{ $results->user->id }}">{{ $results->user->name }}</a><br>
                                            Ubicación: {{ $results->user->info->city }} <br>
                                            Publicado: {{ Date::parse($results->created)->diffForHumans() }}
                                        </p>
                                        <p>
                                            E-mail:
                                            <a class="" href="mailto:{{ $results->user->email }}">
                                                {{ $results->user->email }}
                                            </a>
                                            <br>
                                            Telefono:
                                            <a class="" href="tel:{{ $results->user->phone }}">
                                                {{ $results->user->phone }}
                                            </a>
                                        </p>
                                        <h5>Sobre el envio</h5>
										<p>
                                            Estado del envio: {{ $results->status }} <br>
                                            Tracking: {{ $results->tracking }} <br>
                                            Acepta ofertas: {{ $results->auction }} <br>
                                            Precio: {{ $results->currency }} {{ $results->price }} <br>
                                        </p>
									</div>
									<!--end::Widget 11-->
								<!-- </div> -->
							</div>
						</div>
                    </div>
                    @if(count($images)>0)
                    <div class="col-xl-7">
						<!--begin:: Widgets/Application Sales-->
						<div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__body">
								<!-- <div class="tab-content"> -->
								<!--begin::Widget 11-->
								<div class="m-widget6">
                                    <div class="row">
                                        @foreach($images as $image)
                                        <div class="col-md-4 col-sm-6 col-lg-3" style="padding-bottom:20px;">
                                            <img src="/{{$image->name}}" alt="{{ $results->title }}" class="img-fluid">
                                        </div>
                                        @endforeach
                                    </div>
								</div>
								<!--end::Widget 11-->
								<!-- </div> -->
							</div>
						</div>
						<!--end:: Widgets/Application Sales-->
					</div>
                    @endif

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
