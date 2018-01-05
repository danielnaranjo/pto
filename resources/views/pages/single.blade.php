@extends('layouts.app')

@section('title', $titulo)

@section('content')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<!--Begin::Main Portlet-->
				<div class="row">
					<div class="col-xl-6">
						<!--begin:: Widgets/Application Sales-->
						<div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Envio de {{ $results->from->name }} ({{ $results->from->code }}) a {{ $results->to->name }} ({{ $results->to->code }})
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
                                @if(count($images)>0)
                                    <!--begin::Widget 11-->
                                    <div class="m-widget6">
                                        <div class="row">
                                            @foreach($images as $image)
                                            <div class="col-md-4 col-sm-6 col-lg-3" style="padding-bottom:20px;">
                                                <a href="#">
                                                    <img src="/{{$image->name}}" alt="{{ $results->title }}" class="img-fluid rounded">
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Widget 11-->
                                @endif
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
							</div>
						</div>
						<!--end:: Widgets/Application Sales-->
					</div>
                    <div class="col-xl-3">
                        <div class="m-portlet m-portlet--full-height ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Sobre el envio
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <!--begin::Widget 11-->
                                <div class="m-widget6">
                                    <h5>
                                        @if($results->price>0)
                                            Precio
                                            @if($results->auction=='Y')
                                                desde
                                            @endif
                                            {{ $results->currency or '$' }}
                                            {{ $results->price }}
                                        @else
                                            Gratis
                                        @endif
                                    </h5>
                                    <p>
                                        <!-- Acepta ofertas: {{ $results->auction }} <br> -->
                                        @if($results->auction=='Y')
                                            Negociable
                                        @else
                                            @if($results->price>0)
                                                Monto fijo
                                            @endif
                                        @endif
                                        <br><br>
                                        @if($results->status>0)
                                            Tracking:<br>
                                            <a href="#">{{ $results->tracking }}</a><br><br>
                                        @endif

                                        @if($results->status==3)
                                            @component('components.alert')
                                                @slot('class')
                                                    success
                                                @endslot
                                                @slot('text')
                                                    Estado del envio: Entregado
                                                @endslot
                                            @endcomponent
                                        @elseif($results->status==2)
                                            @component('components.alert')
                                                @slot('class')
                                                    warning
                                                @endslot
                                                @slot('text')
                                                    Estado del envio: En revisión
                                                @endslot
                                            @endcomponent
                                        @elseif($results->status==1)
                                            @component('components.alert')
                                                @slot('class')
                                                    info
                                                @endslot
                                                @slot('text')
                                                    Estado del envio: En transito
                                                @endslot
                                            @endcomponent
                                        @else
                                            Estado del envio: <strong>Disponible</strong><br><br><br>
                                            <button type="button" class="btn btn-success btn-block">Tomar este Paqueto Envio</button>
                                        @endif
                                    </p>
                                    <p>
                                        Compartir en:
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-secondary">Facebook</button>
                                            <button type="button" class="btn btn-secondary">Twitter</button>
                                        </div>
                                    </p>
                                </div>
                                <!--end::Widget 11-->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Sobre el anunciante
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<!-- <div class="tab-content"> -->
									<!--begin::Widget 11-->
									<div class="m-widget6">
                                        <!-- <h5>Sobre el anunciante</h5> -->
										<p>
                                            Publicado por: <a href="/u/{{ $results->user->slug }}">{{ $results->user->name }}</a><br>
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
									</div>
									<!--end::Widget 11-->
								<!-- </div> -->
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
