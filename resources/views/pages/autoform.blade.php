@extends('layouts.app')

@section('title', $titulo)

@section('content')

@php
    //$rutanueva = substr ( url()->current(), -1 );
    function safeInputs($nombre){
    $replace = array(
        'Á'=>'A', 'É'=>'E','Í'=>'I', 'Ó'=>'O','Ú'=>'U', 'Ñ'=>'N',
        'á'=>'a', 'é'=>'e','í'=>'i', 'ó'=>'o','ú'=>'u', 'ñ'=>'n',
        ' '=>''
    );
    return strtolower( strtr( $nombre, $replace) );
}
@endphp
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<!--Begin::Main Portlet-->
				<div class="row">
					<div class="col-xl-7 col-md-7">
						<!--begin:: Widgets/Application Sales-->
						<div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
                                            <strong style="text-transform:capitalize !important">{{$titulo}}</strong>
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools" style="display:none;">
                                    <div class="m-widget11__action m--align-right">
                                        @if(Session::get('nivel')<3)
                                            <button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--hover-brand">
                                                Generar Reporte
                                            </button>
                                        @endif
                                    </div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="tab-content">
									<!--begin::Widget 11-->
									<div class="m-widget11">
										<div class="table-responsive">

                                            @if($errors->all())
                                                @foreach ($errors->all() as $message)
                                                <div class="alert alert-danger alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    {{ $message  }}
                                                </div>
                                                @endforeach
                                            @endif

                                            @foreach ($results[0] as $key => $value)
                                                @php
                                                    $fields[] = $key;
                                                    // $fotografias
                                                    $fotografias = [];
                                                @endphp
                                            @endforeach

                                            {{-- Form::open($parametros)  --}}
                                            @php
                                                $rutaactual = explode('.',Route::currentRouteName())[0];
                                            @endphp
                                                @if(preg_match("/edit/i", Route::currentRouteName() ))
                                                    @php
                                                        $accion='update';
                                                    @endphp
                                                    {{--$parametros = [ 'url' => $rutaactual.'/update' ];--}}
                                                    {!! Form::model($results, ['method' => 'PATCH', 'action' => [$_controller.'@'.$accion, $_id]]) !!}
                                                @else
                                                    @php
                                                        $accion='store';
                                                        if(!Session::has('inmobiliaria')){
                                                            $_id = '';
                                                            $id = '';
                                                        } else {
                                                            $_id = $_GET['id'];//TODO
                                                            $id = $_GET['id'];//TODO
                                                        }
                                                    @endphp
                                                    {{--$parametros = [ 'url' => $rutaactual.'/store' ];--}}
                                                    {!! Form::model($results, ['method' => 'POST', 'action' => [$_controller.'@'.$accion ]]) !!}
                                                @endif

                                                @foreach ($results as $result)
                                                    @foreach ($fields as $f)

                                                        <div class='form-group'>

                                                            @if (!preg_match("/id/i", $f) &&
                                                                    !preg_match("/fechaenvio/i", $f)
                                                                )
                                                                {{-- label --}}
                                                        	    {{-- Form::label( $f, $f ) --}}
                                                                {!! Form::label( $f, __('messages.'.$f) ) !!}
                                                            @endif

                                                            @php
                                                                if( preg_match("/edit/i", Route::currentRouteName() )) {
                                                                    $valor = $result->$f;
                                                                }else{
                                                                    $valor = '';
                                                                }
                                                            @endphp

                                                            @if (preg_match("/description/i", $f)  || strlen($result->$f) >= 200 || preg_match("/description/i", $f) || preg_match("/text/i", $f) || preg_match("/comment/i", $f) || preg_match("/restrictions/i", $f) || preg_match("/restrictions/i", $f))
                                                                {{-- textearea --}}
                                                    	        {!! Form::textarea(safeInputs($f), $valor, ['class' => 'form-control summernote', 'id' => safeInputs($f), 'rows'=> '10', 'placeholder'=> __('messages.'.$f)]) !!}
                                                            @elseif ( preg_match("/date/i", $f) ||  preg_match("/delivery/i", $f) || preg_match("/created/i", $f))
                                                                {{-- date --}}
                                                    	        {!! Form::text(safeInputs($f), $valor, ['class' => 'form-control m_datetimepicker_2', 'id' => safeInputs($f), 'placeholder'=>'AAAA-MM-DD']) !!}
                                                            @elseif ( preg_match("/email/i", $f))
                                                                {{-- email --}}
                                                    	        {!! Form::email(safeInputs($f), $valor, ['class' => 'form-control', 'id' => safeInputs($f), 'placeholder'=> __('messages.'.$f) ]) !!}
                                                            @elseif ( preg_match("/enviado/i", $f) || preg_match("/leido/i", $f))
                                                                {{-- select --}}
                                                                {!! Form::select(safeInputs($f), [0 => 'No', '1' => 'Si'], $valor, ['class' => 'form-control', 'id' => safeInputs($f)]) !!}
                                                            @elseif ( preg_match("/transportation/i", $f))
                                                                {{-- select --}}
                                                                {!! Form::select(safeInputs($f), ['NA' => 'No especifico', 'plane' => 'Avión', 'ground' => 'Terrestre', 'sea' => 'Barco'], $valor, ['class' => 'form-control', 'id' => safeInputs($f)]) !!}
                                                            @elseif ( ( preg_match("/_id/i", $f)))
                                                                {{-- input[text] --}}
                                                                {!! Form::text(safeInputs($f), $valor, ['class' => 'form-control', 'id' => safeInputs($f), 'placeholder'=> __('messages.'.$f)]) !!}

                                                            @elseif ( preg_match("/image/i", $f) || preg_match("/arch/i", $f) || preg_match("/logo/i", $f) )
                                                                {{-- input[file] --}}
                                                                <div class="m-dropzone dropzone" action="/archivos/upload/{{ $_id }}/{{ $f }}/{{$rutaactual}}" id="m-dropzone-one" multiple="multiple">
                    												<div class="m-dropzone__msg dz-message needsclick">
                    													<h3 class="m-dropzone__msg-title">
                    														Arrastra el archivo o haz clic aqui para subirlo
                    													</h3>
                    													<span class="m-dropzone__msg-desc">
                    													    Formatos soportados: JPG, PDF, GIF, PNG, DOC, XLS
                    													</span>
                    												</div>
                    											</div>
                                                                @if($valor)
                                                                    Click <a href="/envios/{{$valor}}" target="_blank">aqui</a> para ver Archivo Actual.
                                                                    @php
                                                                        $fotografias[$f] = $valor;
                                                                    @endphp
                                                                @endif
                                                            @elseif( is_object( $result->$f ) )
                                                                {{-- select[option] --}}
                                                                @php
                                                                    foreach($result->$f as $key => $value):
                                                                        foreach($value as $k => $v):
                                                                            if( is_int($v) ){
                                                                                $item = $v;
                                                                            }
                                                                            if( is_string($v) ){
                                                                                $valores[$item] = $v;
                                                                            }
                                                                        endforeach;
                                                                    endforeach;
                                                                @endphp
                                                                {!! Form::select(safeInputs($f), $valores, $valor, ['placeholder' => 'Seleccionar', 'class' => 'form-control', 'id' => safeInputs($f)]) !!}
                                                            @else
                                                                {{-- input[text] --}}
                                                                {!! Form::text(safeInputs($f), $valor, ['class' => 'form-control', 'id' => safeInputs($f), 'placeholder'=> __('messages.'.$f)]) !!}
                                                            @endif
                                                        </div>

                                                    @endforeach
                                                @endforeach

                                                @if(preg_match("/propietarios.create/i", Route::currentRouteName() ) && $_GET['id'])
                                                    {!! Form::hidden ('pro_consorcio', $_GET['id'], ['id' => 'pro_consorcio']) !!}
                                                @endif

                                                @if ( preg_match("/edit/i", Route::currentRouteName() ))
                                                    {{ Form::submit('Guardar', ['class'=>'btn btn-info m-btn--pill']) }}
                                                    @if( preg_match("/envios.edit/i", Route::currentRouteName()))
                                                        <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="/envios/ahora/{{$id}}">
                                                            Enviar a todos
                                                        </a>
                                                    @endif
                                                    @if( preg_match("/alertas.edit/i", Route::currentRouteName()))
                                                        <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="/alertas/ahora/{{$id}}">
                                                            Enviar a todos
                                                        </a>
                                                    @endif
                                                    @if( preg_match("/masivos.edit/i", Route::currentRouteName()))
                                                        <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="/masivos/ahora/{{$id}}">
                                                            Enviar a todos
                                                        </a>
                                                    @endif
                                                    <a class="btn btn-secondary m-btn--pill m-btn m-btn--custom" href="javascript:history.back();">Volver</a>
                                                    <a class="btn btn-danger pull-right m-btn--pill" href="{{ url()->previous() }}/{{ $_id }}/delete" class="btn btn-default" onclick='return confirm("Desea eliminar este registro?")' data-toggle="tooltip" data-placement="bottom" title="Eliminar">Eliminar</a>
                                                @elseif ( preg_match("/envios.create/i", Route::currentRouteName()))
                                                    {{ Form::submit('Guardar', ['class'=>'btn btn-info m-btn--pill']) }}
                                                    {{ Form::submit('Enviar a todos', ['class'=>'btn btn-info m-btn--pill', 'name'=>'saveandsend', 'value'=>'saveandsend']) }}
                                                    <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="javascript:history.back();">
                                                        Volver
                                                    </a>
                                                @elseif ( preg_match("/alertas.create/i", Route::currentRouteName()))
                                                    {{ Form::submit('Guardar', ['class'=>'btn btn-info m-btn--pill']) }}
                                                    <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="/alertas/inmediato">
                                                        Enviar a todos
                                                    </a>
                                                    <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="javascript:history.back();">
                                                        Volver
                                                    </a>
                                                @else
                                                    {{ Form::submit('Guardar', ['class'=>'btn btn-info m-btn--pill']) }}
                                                @endif


                                                @if ( preg_match("/travel.create/i", Route::currentRouteName()))
                                                    {!! Form::hidden ('user_id', Auth::user()->id, ['id' => 'user_id']) !!}
                                                @endif


                                            {{-- Form::close() --}}
                                            {!! Form::close() !!}

                                            {{-- $rutaactual --}}
                                            {{-- Route::currentRouteName() --}}
                                            {{-- url()->current() --}}
                                        </div>
                                    </div>
                                    <!--end::Widget 11-->
                                </div>
                            </div>
                        </div>
                    <!--end:: Widgets/Application Sales-->
                    </div>
                    <div class="col-xl-4 col-md-4">
                        @if ( preg_match("/travel.create/i", Route::currentRouteName()))
                        <div class="m-portlet m--bg-accent m-portlet--bordered-semi m-portlet--skin-dark" id="preview">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Viajando desde <span id="desde" data-toggle="tooltip" data-placement="bottom" title="" class="destacar" data-original-title="Desde">Punto A</span> a <span id="hasta" data-toggle="tooltip" data-placement="bottom" title="" class="destacar" data-original-title="Hasta">Punto B</span>
                                        </h3>
                                    </div>
                                </div>
                            </div> <div class="m-portlet__body">
                                <div class="m-widget7 m-widget7--skin-dark">
                                    <div class="m-widget7__desc">
                                        Viajo en <span data-toggle="tooltip" data-placement="bottom" title="" class="destacar" data-original-title="Medio de transporte" id="transporte">
                                            (ej. medio de transporte)
                                        </span>
                                        tengo disponible
                                        <span data-toggle="tooltip" data-placement="bottom" title="" class="destacar" data-original-title="Peso establecido" id="peso">
                                            (ej. 00 kilos)
                                        </span>
                                        para llevar
                                        <span data-toggle="tooltip" data-placement="bottom" title="" class="destacar" data-original-title="Tamaño permitido" id="maleta">
                                            (ej. tengo disponible una maleta mediana de 00 pies)
                                        </span>
                                        no llevo
                                        <span data-toggle="tooltip" data-placement="bottom" title="" class="destacar" data-original-title="Articulos prohibidos" id="prohibidos">
                                            (ej. No llevo liquidos ni comida)
                                        </span>
                                    </div>
                                    <div class="m-widget7__user">
                                        <div class="m-widget7__user-img">
                                            <img src="{{ Auth::user()->avatar }}" alt="avatar" class="m-widget7__img">
                                        </div>
                                        <div class="m-widget7__info">
                                            <span class="m-widget7__username">
                                                {{ Auth::user()->name }}
                                            </span> <br>
                                            <span class="m-widget7__time">
                                                hace segundos
                                            </span>
                                        </div>
                                    </div>
                                    <div class="m-widget7__button">
                                        <a href="/u/{{ Auth::user()->slug }}" role="button" class="m-btn m-btn--pill btn btn-info">
                                            Contactar a {{ Auth::user()->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            <!--End::Main Portlet-->
            </div>
        </div>
    </div>
</div>
@endsection
