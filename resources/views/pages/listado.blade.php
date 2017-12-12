@extends('layouts.app')

@section('title', $titulo)

@section('content')

@php
    $rutaactual = explode('.',Route::currentRouteName())[0];
    if(preg_match("/consorcios.index/i", Route::currentRouteName() ))
        {$rutanueva = substr ( url()->current(), -1 );}
    else
        {$rutanueva = $_id;}

@endphp
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<!--Begin::Main Portlet-->
				<div class="row">
                    @if(Session::has('consorcio') && preg_match( "/expensas/i", url()->current()) )
                    <!-- consorcio -->
                    <div class="col-lg-3">
                        <!--begin::Portlet-->
                        <div class="m-portlet m-portlet--mobile">
                            <!-- <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            <img alt="logo" src="/img/building33.png" class="img-responsive " style="height:80px; padding-top:0;"  />
                                        </h3>
                                    </div>
                                </div>
                            </div> -->
                            <div class="m-portlet__body">
                                <h5><strong>{{ Session::get('consorcio')[0]->inm_nombre }}</strong></h5>
                                {{ Session::get('consorcio')[0]->inm_direccion }}<br>
                                E-mail: <a href="mailto:{{ Session::get('consorcio')[0]->inm_email }}">{{ Session::get('consorcio')[0]->inm_email }}</a><br>
                                Tel. {{ Session::get('consorcio')[0]->inm_telefono }}<br>
                                Web: <a href="{{ Session::get('consorcio')[0]->inm_web }}" target="_blank">
                                    {{ Session::get('consorcio')[0]->inm_web }}
                                </a>
                            </div>
                        </div>
                        <!--end::Portlet-->
                    </div>
                    @foreach($payments as $payment)
                    <div class="col-lg-3">
                        <!--begin::Portlet-->
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__body">
                                <h5><strong>Formas de pago</strong></h5>
                                {{ $payment->for_tipo }}<br>
                                {{ $payment->for_informacion }}
                                </a>
							</div>
						</div>
						<!--end::Portlet-->
                    </div>
                    @endforeach
                    <!-- consorcio -->
                    @endif
					<div class="col-xl-12">
						<!--begin:: Widgets/Application Sales-->
						<div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											<strong>{{$titulo}}</strong>
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
                                    <div class="m-widget11__action m--align-right">
                                        {{-- $rutaactual --}}
                                        {{-- Route::currentRouteName() --}}
                                        {{-- url()->current() --}}
                                    </div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="tab-content">
									<!--begin::Widget 11-->
									<div class="m-widget11">

                                        @if (session('status'))
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{ session('status') }}
                                            </div>
                                        @endif

										<div class="table-responsive">
											<!--begin::Table-->
                                            {{-- Session::get('consorcio')[0]->con_id --}}
                                            @if (count($results)>0)
                                            <table class="table">
                                                <!--begin::Thead-->
                                                <thead>
                                                    <?php foreach ($results[0] as $key => $value) : ?>
                                                        <?php $fields[] = $key; ?>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        @foreach ($fields as $field)
                                                        @if (preg_match("/_id/i", $field))
                                                        <!-- <td>
                                                            #
                                                        </td> -->
                                                        @else
                                                        <td class="mayusculas">
                                                            {{ substr ( $field, 4, strlen($field) ) }}
                                                        </td>
                                                        @endif
                                                        @endforeach

                                                    </tr>
                                                </thead>
                                                <!--end::Thead-->
                                                <!--begin::Tbody-->
                                                <tbody>
                                                    @forelse ($results as $result)
                                                    <tr>
                                                        @foreach ($fields as $f)
                                                            @if (preg_match("/_id/i", $f))
                                                            @php
                                                                $ID = $result->$f;
                                                            @endphp
                                                            <!-- <td>
                                                                <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                                    <input type="checkbox" name="item" value="{{ $result->$f }}" onclick="javascript:move('/{{ $rutaactual }}/{{ $ID }}/edit')" >
                                                                    <span></span>
                                                                </label>
                                                            </td> -->
                                                            @else
                                                            <td>
                                                                @if(preg_match("/fecha/i", $f))
                                                                    {{ Carbon\Carbon::parse($result->$f)->format('d/m/Y') }}
                                                                @elseif(preg_match("/web/i", $f))
                                                                    @if($result->$f!='')
                                                                        <a href="//{{ $result->$f }}/?ref=tuconsorcio.com.ar" target="_blank">Visitar</a>
                                                                    @endif
                                                                @elseif(preg_match("/email/i", $f))
                                                                    <a href="mailto:{{ $result->$f }}?subject=Contacto+via+tuconsorcio.com.ar" target="_blank">E-mail</a>
                                                                @elseif(preg_match("/enviado/i", $f) || preg_match("/leido/i", $f))
                                                                    @if($result->$f==1)
                                                                        Si
                                                                    @else
                                                                        No
                                                                    @endif
                                                                @else
                                                                    @if ($result->$f=='')
                                                                        {{''}}
                                                                    @else
                                                                        {!! $result->$f !!}
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                    @empty
                                        				<p>No hay registros para mostrar</p>
                                        			@endforelse
                                                </tbody>
                                                <!--end::Tbody-->
                                            </table>
                                            @else
                                                <p>No hay registros para mostrar</p>
                                            @endif
                                            <p>
                                                {{ $results->links() }}
                                                @if( !preg_match( "/index/i", Route::currentRouteName()) && !preg_match( "/expensas/i", url()->current()))
                                                    <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="javascript:history.back();">
                                                        Volver
                                                    </a>
                                                @endif
                                            </p>
											<!--end::Table-->
										</div>
									</div>
									<!--end::Widget 11-->
								</div>
							</div>
						</div>
						<!--end:: Widgets/Application Sales-->
					</div>
				</div>
				<!--End::Main Portlet-->
			</div>
		</div>
	</div>
</div>

@endsection
