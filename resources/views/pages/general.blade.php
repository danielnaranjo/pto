@extends('layouts.app')

@section('title', $titulo)

@section('content')

@php
    $rutaactual = explode('.',Route::currentRouteName())[0];
    if(preg_match("/consorcios.index/i", Route::currentRouteName() ))
        { $rutanueva = substr ( url()->current(), -1 ); }
    else
        { $rutanueva = $_id; }
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
					<div class="col-md-12 col-xl-12">
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
                                        @if(Session::has('nivel'))
                                            @if(Session::get('nivel')!=2 && preg_match("/envio.consorcio/i", Route::currentRouteName() ))
                                                <a href="/envios/create?id={{ $rutanueva }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                    Nuevo Envio
                                                </a>
                                            @endif
                                        @endif
                                        @if(preg_match("/propietarios\/envios/i", url()->current() ))
                                            <a href="/envios/create?id={{$rutanueva}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nuevo Envio
                                            </a>
                                            <a href="/propietarios/alertas/{{$rutanueva}}" class="btn m-btn--pill btn-default m-btn m-btn--custom">
                                                Ir a Avisos
                                            </a>
                                        @endif
                                        @if(preg_match("/consorcios.index/i", Route::currentRouteName() ))
                                            @if(Session::has('nivel'))
                                                @if(Session::get('nivel')==1)
                                                    <a href="/consorcios/create?id={{ $id }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                        Nuevo Consorcio
                                                    </a>
                                                    <a href="javascript:importar({{ $id }})" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                        Importación Masiva
                                                    </a>
                                                @endif
                                                @if(Session::has('administrador'))
                                                    @php
                                                        $rutaalternativa = "?id=".$_id
                                                    @endphp
                                                    <a href="/consorcios/create{{ $rutaalternativa or '' }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                        Nuevo Consorcio
                                                    </a>
                                                @endif
                                            @endif
                                        @endif
                                        @if(Session::get('nivel')!=2 && preg_match("/envio.index/i", Route::currentRouteName() ))
                                            <a href="/envios/create?id={{ $id }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nuevo Envio
                                            </a>
                                        @endif
                                        @if(Session::get('nivel')!=2 && preg_match("/alertas.consorcio/i", Route::currentRouteName() ))
                                            <a href="/alertas/create?id={{ $id }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nuevo Aviso
                                            </a>
                                            <a href="/propietarios/envios/{{ $id}}" class="btn m-btn--pill btn-default m-btn m-btn--custom">
                                                Ir a Envios
                                            </a>
                                        @endif
                                        @if(Session::get('nivel')!=2 && preg_match("/documentos/i", Route::currentRouteName() ))
                                            <a href="/documentos/create?id={{$id}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nuevo Reglamento
                                            </a>
                                        @endif
                                        @if(Session::get('nivel')==1 && preg_match("/utiles/i", Route::currentRouteName() ))
                                            <a href="/utiles/create?id={{$id}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nuevo Servicio
                                            </a>
                                        @endif
                                        @if(Session::get('nivel')==0 && preg_match("/utilesadministrador/i", Route::currentRouteName() ))
                                            <a href="/utilesadministrador/create" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nuevo Servicio
                                            </a>
                                        @endif
                                        @if(Session::get('nivel')!=2 && preg_match("/inmobiliarias/i", Route::currentRouteName() ))
                                            <a href="/inmobiliarias/create" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nueva Administración
                                            </a>
                                        @endif

                                        @if(Session::get('nivel')==0 && preg_match("/noticias/i", Route::currentRouteName() ))
                                            <a href="/noticias/create" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nueva Noticia
                                            </a>
                                        @endif
                                        @if(Session::get('nivel')==1 && preg_match("/propietarios/i", Route::currentRouteName() ))
                                            <a href="/propietarios/create?id={{$id}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nuevo Propietario
                                            </a>
                                        @endif
                                        @if(Session::get('nivel')==1 && preg_match("/calendario.show/i", Route::currentRouteName() ))
                                            <a href="/calendario/create?id={{$_id}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nuevo Actividad
                                            </a>
                                        @endif
                                        @if(Session::get('nivel')!=2 && preg_match("/masivos/i", Route::currentRouteName() ))
                                            <a href="/masivos/create?id={{ $id }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nuevo Aviso Masivo
                                            </a>
                                        @endif
                                        @if(Session::get('nivel')!=2 && preg_match("/docmas/i", Route::currentRouteName() ))
                                            <a href="/docmas/create?id={{ $id }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                                Nuevo Documento Masivo
                                            </a>
                                        @endif
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


                                                        <td class="mayusculas">
                                                            @if(!Session::has('consorcio'))
                                                                <!-- Opciones -->
                                                            @endif
                                                        </td>

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
                                                                @elseif(preg_match("/archivo/i", $f))
                                                                    @if($result->$f!='')
                                                                        <a href="/uploads/{{ $result->$f }}" target="_new" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Visualizar">
                                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                                        </a>
                                                                    @endif
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

                                                            <td class="opciones">
                                                                @if(!Session::has('consorcio'))
                                                                    <a href="/{{ $rutaactual }}/{{ $ID }}/edit" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                    @if(Session::has('nivel'))
                                                                        @if(Session::get('nivel')==2)
                                                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#automodal" title="Visualizar">Ver</a>
                                                                            </button>
                                                                        @else
                                                                            @if( Session::get('nivel')==1 && preg_match("/consorcios/i", Route::currentRouteName() ))
                                                                                <a href="/propietarios/{{ $ID }}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Propietarios">
                                                                                    <i class="fa fa-users"></i>
                                                                                </a>
                                                                                <a href="javascript:passwords({{ $ID }});" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Envio de passwords">
                                                                                    <i class="fa fa-key"></i>
                                                                                </a>
                                                                                <a href="/propietarios/envios/{{ $ID }}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Envio de Expensas">
                                                                                    <i class="fa fa-folder-open-o"></i>
                                                                                </a>
                                                                                <a href="/propietarios/alertas/{{ $ID }}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Envio de Avisos">
                                                                                    <i class="fa fa-bullhorn"></i>
                                                                                </a>
                                                                                <a href="/propietarios/documentos/{{ $ID }}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Reglamentos">
                                                                                    <i class="fa fa-book"></i>
                                                                                </a>
                                                                                <a href="/propietarios/utiles/{{ $ID }}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Servicios útiles">
                                                                                    <i class="fa fa-wrench"></i>
                                                                                </a>
                                                                                <a href="/propietarios/calendario/{{ $ID }}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Calendario de actividades">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </a>
                                                                            @endif
                                                                            @if( Session::get('nivel')==0 && preg_match("/inmobiliaria/i", Route::currentRouteName() ))
                                                                                <a href="/consorcios/{{ $ID }}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Consorcios">
                                                                                    <i class="fa fa-building-o"></i>
                                                                                </a>
                                                                                <a href="javascript:setStatus('inmobiliarias',{{ $ID }});" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Suspensiones">
                                                                                    <i class="fa fa-lock"></i>
                                                                                </a>
                                                                            @endif
                                                                            @if( Session::get('nivel')==0 && preg_match("/consorcios/i", Route::currentRouteName() ))
                                                                                <a href="/propietarios/{{ $ID }}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Propietarios">
                                                                                    <i class="fa fa-users"></i>
                                                                                </a>
                                                                                <a href="javascript:setStatus('consorcios',{{ $ID }});" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Suspensiones">
                                                                                    <i class="fa fa-lock"></i>
                                                                                </a>
                                                                            @endif
                                                                            @if( Session::has('inmobiliaria') )
                                                                                @if(preg_match("/envio/i", Route::currentRouteName() ) || preg_match("/alertas/i", Route::currentRouteName() ) || preg_match("/masivos/i", Route::currentRouteName() ))
                                                                                    <a href="javascript:send({{ $ID }});" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Enviar">
                                                                                        <i class="fa fa-paper-plane-o"></i>
                                                                                    </a>
                                                                                    <a href="javascript:agenda({{ $ID }}, '{{ explode('.',Route::currentRouteName())[0] }}' );" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Programar envio" id="programado{{ $ID }}">
                                                                                        <i class="fa fa-clock-o"></i>
                                                                                    </a>
                                                                                @endif
                                                                            @endif
                                                                            @if( Session::has('inmobiliaria') || Session::has('administrador') )
                                                                                @if(preg_match("/propietarios.show/i", Route::currentRouteName() ))
                                                                                <a href="javascript:setStatus('propietarios',{{ $ID }});" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Suspensiones">
                                                                                    <i class="fa fa-lock"></i>
                                                                                </a>
                                                                                @endif
                                                                                @if(preg_match("/consorcios.index/i", Route::currentRouteName() ))
                                                                                <a href="javascript:setStatus('consorcios',{{ $ID }});" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Suspensiones">
                                                                                    <i class="fa fa-lock"></i>
                                                                                </a>
                                                                                @endif
                                                                            @endif
                                                                            <a href="javascript:borrar('{{ $rutaactual }}',{{ $ID }});" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                                                                                <i class="fa fa-trash"></i>
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                                @if(Session::has('consorcio') && preg_match("/alertas/i", Route::currentRouteName() ) ||  preg_match("/documentos/i", Route::currentRouteName() ))
                                                                    <a href="javascript:mostrar({{ $ID }});" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Mostrar">
                                                                        <i class="fa fa-search"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
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
                                                <!-- Mostrando {{ $results->count() }} de {{$results->total()}} -->
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
    @if( Session::get('nivel')!=2 && preg_match("/envio/i", Route::currentRouteName() ) )
        <!-- envios -->
        @component('components.modal', ['id' => 'enviar'])
            @slot('title')
                Envio de expensas
            @endslot
            @slot('form')
                {!! Form::open(['url' => '', 'id'=>'expensas']) !!}
                {!! Form::hidden('_id', '0', ['id' => '_id']) !!}
                <div class='form-group'>
                    {!! Form::label('email', 'Destinatarios ') !!}
                    {!! Form::textarea('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder'=>'info@tuconsorcio.com.ar, esteban@hotmail.com, pepe@...', 'rows'=>'3']) !!}
                    <p class="help-block">
                        Si desea enviarle a uno o varios destinatarios en particular, ingrese los mails separados por coma
                    </p>
                </div>
                {{ Form::submit('Envio personalizado', ['class'=>'btn btn-info btn-block m-btn--pill', 'id'=>'btnSoloEnvio']) }}
                <p style="text-align: center;margin:20px;">ó</p>
                {{ Form::submit('Enviar a todo el consorcio', ['class'=>'btn btn-success btn-block m-btn--pill', 'id'=>'btnAllEnvio']) }}
                {!! Form::close() !!}
            @endslot
        @endcomponent

        @component('components.modal', ['id' => 'programar'])
            @slot('title')
                Programar Envio de Expensas
            @endslot
            @slot('form')
                {!! Form::open(['url' => '', 'id'=>'expensas']) !!}
                {!! Form::hidden('_id', '0', ['id' => '_id']) !!}
                <div class='form-group'>
                    {!! Form::label('horario', 'Fecha y Hora de Envio') !!}
                    {!! Form::text('tiempo', null, ['class' => 'form-control', 'id' => 'm_datetimepicker_1', 'required'=>'required']) !!}
                    <p class="help-block">
                        ej. AAAA-MM-DD HH:MM <span id="reloj"></span>
                    </p>
                </div>
                {{ Form::submit('Programar Envio', ['class'=>'btn btn-info btn-block m-btn--pill', 'id'=>'btnProgramar']) }}
                <p style="text-align: center;margin:20px;">ó</p>
                {{ Form::submit('Anular programación', ['class'=>'btn btn-danger btn-block m-btn--pill', 'id'=>'btnAnularEnvios' ]) }}
                {!! Form::close() !!}
            @endslot
        @endcomponent
        <!-- envios -->
    @endif

    @if( Session::get('nivel')!=2 && preg_match("/alerta/i", Route::currentRouteName() ) )
        <!-- alertas -->
        @component('components.modal', ['id' => 'enviar'])
            @slot('title')
                Envio de Alertas
            @endslot
            @slot('form')
                {!! Form::open(['url' => '', 'id'=>'alertas']) !!}
                {!! Form::hidden('_id', '0', ['id' => '_id']) !!}
                <div class='form-group'>
                    {!! Form::label('email', 'Destinatarios ') !!}
                    {!! Form::textarea('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder'=>'info@tuconsorcio.com.ar, esteban@hotmail.com, pepe@...', 'rows'=>'3']) !!}
                    <p class="help-block">
                        Si desea enviarle a uno o varios destinatarios en particular, ingrese los mails separados por coma
                    </p>
                </div>
                {{ Form::submit('Envio personalizado', ['class'=>'btn btn-info btn-block m-btn--pill', 'id'=>'btnSoloAlertas']) }}
                <p style="text-align: center;margin:20px;">ó</p>
                {{ Form::submit('Enviar a todo el consorcio', ['class'=>'btn btn-success btn-block m-btn--pill', 'id'=>'btnAllAlertas']) }}
                {!! Form::close() !!}
            @endslot
        @endcomponent

        @component('components.modal', ['id' => 'programar'])
            @slot('title')
                Programar Envio de Alertas
            @endslot
            @slot('form')
                {!! Form::open(['url' => '', 'id'=>'alertas']) !!}
                {!! Form::hidden('_id', '0', ['id' => '_id']) !!}
                <div class='form-group'>
                    {!! Form::label('horario', 'Fecha y Hora de Envio') !!}
                    {!! Form::text('tiempo', null, ['class' => 'form-control', 'id' => 'm_datetimepicker_1', 'required'=>'required']) !!}
                    <p class="help-block">
                        ej. AAAA-MM-DD HH:MM <span id="reloj"></span>
                    </p>
                </div>
                {{ Form::submit('Programar Envio', ['class'=>'btn btn-info btn-block m-btn--pill', 'id'=>'btnProgramarAlertas']) }}
                <p style="text-align: center;margin:20px;">ó</p>
                {{ Form::submit('Anular programación', ['class'=>'btn btn-danger btn-block m-btn--pill', 'id'=>'btnAnularAlertas']) }}
                {!! Form::close() !!}
            @endslot
        @endcomponent
        <!-- alertas -->
    @endif

    @if( Session::get('nivel')!=2 && preg_match("/consorcios.index/i", Route::currentRouteName()) || !preg_match("/home/i", Route::currentRouteName() ) )
        <!-- password -->
        @component('components.modal', ['id' => 'passwords'])
            @slot('title')
                Envio de Passwords
            @endslot
            @slot('form')
                {!! Form::open(['url' => '']) !!}
                {!! Form::hidden('_id', '0', ['id' => '_id']) !!}
                <div class='form-group'>
                    {!! Form::label('email', 'Destinatarios ') !!}
                    {!! Form::textarea('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder'=>'info@tuconsorcio.com.ar, esteban@hotmail.com, pepe@...', 'rows'=>'3']) !!}
                    <p class="help-block">
                        Si desea enviarle a uno o varios destinatarios en particular, ingrese los mails separados por coma
                    </p>
                </div>
                {{ Form::submit('Envio personalizado', ['class'=>'btn btn-info btn-block m-btn--pill', 'id'=>'btnSoloPassword']) }}
                <p style="text-align: center;margin:20px;">ó</p>
                {{ Form::submit('Enviar a todo el consorcio', ['class'=>'btn btn-success btn-block m-btn--pill', 'id'=>'btnAllPassword']) }}
                {!! Form::close() !!}
            @endslot
        @endcomponent
        <!-- password -->
        <!-- csv -->
        @component('components.modal', ['id' => 'importar'])
            @slot('title')
                Importación masivas
            @endslot
            @slot('form')
                {!! Form::open(['url' => '']) !!}
                {!! Form::hidden('_id', '0', ['id' => '_id']) !!}
                <div class='form-group'>
                    <div class="m-dropzone dropzone" action="/archivos/importar/consorcios" id="m-dropzone-one" multiple="multiple">
                        <div class="m-dropzone__msg dz-message needsclick">
                            <h3 class="m-dropzone__msg-title">
                                Arrastra el archivo o haz clic aqui para subirlo
                            </h3>
                            <span class="m-dropzone__msg-desc">
                                Formato soportado: CSV
                            </span>
                        </div>
                    </div>
                </div>
                {{ Form::submit('Subir archivo', ['class'=>'btn btn-info btn-block m-btn--pill', 'id'=>'btnUploadCSV']) }}
                {!! Form::close() !!}
            @endslot
        @endcomponent
        @component('components.modal', ['id' => 'masivos'])
            @slot('title')
                Importación masivas
            @endslot
            @slot('form')
                {!! Form::open(['url' => '']) !!}
                {!! Form::hidden('_id', '0', ['id' => '_id']) !!}
                <div class='form-group'>
                    <div class="m-dropzone dropzone" action="/archivos/masivos/propietarios" id="m-dropzone-one" multiple="multiple">
                        <div class="m-dropzone__msg dz-message needsclick">
                            <h3 class="m-dropzone__msg-title">
                                Arrastra el archivo o haz clic aqui para subirlo
                            </h3>
                            <span class="m-dropzone__msg-desc">
                                Formato soportado: CSV
                            </span>
                        </div>
                    </div>
                </div>
                {{ Form::submit('Subir archivo', ['class'=>'btn btn-info btn-block m-btn--pill', 'id'=>'btnUploadCSV']) }}
                {!! Form::close() !!}
            @endslot
        @endcomponent
        <!-- csv -->
    @endif

    @if( Session::get('nivel')!=2 && preg_match("/masivos/i", Route::currentRouteName() ) )
        <!-- masivos -->
        @component('components.modal', ['id' => 'enviar'])
            @slot('title')
                Envio de Alertas Masivas
            @endslot
            @slot('form')
                {!! Form::open(['url' => '', 'id'=>'alertas_masivas']) !!}
                {!! Form::hidden('_id', '0', ['id' => '_id']) !!}
                <div class='form-group'>
                    {!! Form::label('email', 'Destinatarios ') !!}
                    {!! Form::textarea('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder'=>'info@tuconsorcio.com.ar, esteban@hotmail.com, pepe@...', 'rows'=>'3']) !!}
                    <p class="help-block">
                        Si desea enviarle a uno o varios destinatarios en particular, ingrese los mails separados por coma
                    </p>
                </div>
                {{ Form::submit('Envio personalizado', ['class'=>'btn btn-info btn-block m-btn--pill', 'id'=>'btnSoloAlertasM']) }}
                <p style="text-align: center;margin:20px;">ó</p>
                {{ Form::submit('Enviar a todo el consorcio', ['class'=>'btn btn-success btn-block m-btn--pill', 'id'=>'btnAllAlertasM']) }}
                {!! Form::close() !!}
            @endslot
        @endcomponent

        @component('components.modal', ['id' => 'programar'])
            @slot('title')
                Programar Envio de Alertas Masivas
            @endslot
            @slot('form')
                {!! Form::open(['url' => '', 'id'=>'alertas_masivas']) !!}
                {!! Form::hidden('_id', '0', ['id' => '_id']) !!}
                <div class='form-group'>
                    {!! Form::label('horario', 'Fecha y Hora de Envio') !!}
                    {!! Form::text('tiempo', \Carbon\Carbon::now()->format('d/m/Y'), ['class' => 'form-control', 'id' => 'm_datetimepicker_1', 'required'=>'required']) !!}
                    <p class="help-block">
                        ej. AAAA-MM-DD HH:MM <span id="reloj"></span>
                    </p>
                </div>
                {{ Form::submit('Programar Envio', ['class'=>'btn btn-info btn-block m-btn--pill', 'id'=>'btnProgramarAlertasM']) }}
                <p style="text-align: center;margin:20px;">ó</p>
                {{ Form::submit('Anular programación', ['class'=>'btn btn-danger btn-block m-btn--pill', 'id'=>'btnAnularAlertasM']) }}
                {!! Form::close() !!}
            @endslot
        @endcomponent
        <!-- masivos -->
    @endif

    @if( Session::get('nivel')==2 && preg_match("/alertas/i", Route::currentRouteName() ) )
        @component('components.modal', ['id' => 'mostrar'])
            @slot('title')
            @endslot
            @slot('form')
            @endslot
        @endcomponent
    @endif

@endsection
