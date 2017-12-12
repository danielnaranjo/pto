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
					<div class="col-xl-8 col-md-8">
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
                                                    {{ substr ( $message, 4, strlen($message) ) }}
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

                                                            @if (!preg_match("/_id/i", $f) &&
                                                                    !preg_match("/fechaenvio/i", $f)
                                                                )
                                                                {{-- label --}}
                                                        	   {!! Form::label( substr ( $f, 4, strlen($f) ) , substr ( $f, 4, strlen($f)) ) !!}
                                                            @endif

                                                            @php
                                                                if( preg_match("/edit/i", Route::currentRouteName() )) {
                                                                    $valor = $result->$f;
                                                                }else{
                                                                    $valor = '';
                                                                }
                                                            @endphp

                                                            @if ( strlen($result->$f) >= 200 || preg_match("/firma/i", $f) || preg_match("/cuerpo/i", $f))
                                                                {{-- textearea --}}
                                                    	        {!! Form::textarea(safeInputs($f), $valor, ['class' => 'form-control summernote', 'id' => safeInputs($f), 'rows'=> '10', 'placeholder'=> substr ( $f, 4, strlen($f) )]) !!}
                                                            @elseif ( preg_match("/fecha/i", $f))
                                                                {{-- date --}}
                                                    	        {!! Form::text(safeInputs($f), $valor, ['class' => 'form-control m_datetimepicker_2', 'id' => safeInputs($f), 'placeholder'=>'AAAA-MM-DD']) !!}
                                                            @elseif ( preg_match("/email/i", $f))
                                                                {{-- email --}}
                                                    	        {!! Form::email(safeInputs($f), $valor, ['class' => 'form-control', 'id' => safeInputs($f), 'placeholder'=> substr ( $f, 4, strlen($f) )]) !!}
                                                            @elseif ( preg_match("/enviado/i", $f) || preg_match("/leido/i", $f))
                                                                {{-- select --}}
                                                                {!! Form::select(safeInputs($f), [0 => 'No', '1' => 'Si'], $valor, ['class' => 'form-control', 'id' => safeInputs($f)]) !!}
                                                            @elseif ( ( preg_match("/_id/i", $f)))
                                                                {{-- input[text] --}}
                                                                {!! Form::hidden (safeInputs($f), $valor, ['id' => safeInputs($f)]) !!}
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
                                                                {!! Form::text(safeInputs($f), $valor, ['class' => 'form-control', 'id' => safeInputs($f), 'placeholder'=> substr ( $f, 4, strlen($f) )]) !!}
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

                                                @if ( preg_match("/envios.create/i", Route::currentRouteName()))
                                                    {!! Form::hidden ('env_consorcio', $_GET['id'], ['id' => 'env_consorcio']) !!}
                                                    {!! Form::hidden ('env_enviado', 0, ['id' => 'env_enviado']) !!}
                                                    {!! Form::hidden ('env_leido', 0, ['id' => 'env_leido']) !!}
                                                    {!! Form::hidden ('env_fecha', \Carbon\Carbon::now()->format('Y-m-d'), ['id' => 'env_fecha']) !!}
                                                    {!! Form::hidden ('env_fechaenvio', '0000-00-00', ['id' => 'env_fechaenvio']) !!}
                                                @endif

                                                @if ( preg_match("/consorcios.create/i", Route::currentRouteName()))
                                                    {!! Form::hidden ('con_inmobiliaria', $_GET['id'], ['id' => 'con_inmobiliaria']) !!}
                                                    {!! Form::hidden ('con_fecha', \Carbon\Carbon::now()->format('Y-m-d'), ['id' => 'con_fecha']) !!}
                                                @endif

                                                @if ( preg_match("/alertas.create/i", Route::currentRouteName()))
                                                    {!! Form::hidden ('ale_consorcio', $_GET['id'], ['id' => 'ale_consorcio']) !!}
                                                    {!! Form::hidden ('ale_enviado', 0, ['id' => 'ale_enviado']) !!}
                                                    {!! Form::hidden ('ale_leido', 0, ['id' => 'ale_leido']) !!}
                                                    {!! Form::hidden ('ale_fecha', \Carbon\Carbon::now()->format('Y-m-d'), ['id' => 'ale_fecha']) !!}
                                                @endif

                                                @if ( preg_match("/masivos.create/i", Route::currentRouteName()))
                                                    {!! Form::hidden ('mas_inmo', $_GET['id'], ['id' => 'mas_inmo']) !!}
                                                    {!! Form::hidden ('mas_enviado', 0, ['id' => 'mas_enviado']) !!}
                                                    {!! Form::hidden ('mas_leido', 0, ['id' => 'mas_leido']) !!}
                                                    {!! Form::hidden ('mas_fecha', \Carbon\Carbon::now()->format('Y-m-d'), ['id' => 'mas_fecha']) !!}
                                                @endif

                                                @if ( preg_match("/documentos.create/i", Route::currentRouteName()))
                                                    {!! Form::hidden ('doc_conso', $_GET['id'], ['id' => 'doc_conso']) !!}
                                                @endif

                                                @if ( preg_match("/docmas.create/i", Route::currentRouteName()))
                                                    {!! Form::hidden ('doc_inmo', $_GET['id'], ['id' => 'mas_inmo']) !!}
                                                @endif

                                                @if ( preg_match("/formasdepago.create/i", Route::currentRouteName()))
                                                    {!! Form::hidden ('consorcio_id', $_GET['id'], ['id' => 'consorcio_id']) !!}
                                                @endif

                                                @if ( preg_match("/utiles.create/i", Route::currentRouteName()))
                                                    {!! Form::hidden ('uti_consorcio', $_GET['id'], ['id' => 'uti_consorcio']) !!}
                                                    {!! Form::hidden ('uti_inmo', Session::get('inmobiliaria')->inm_id, ['id' => 'uti_inmo']) !!}
                                                @endif


                                                @if ( preg_match("/calendario.create/i", Route::currentRouteName()))
                                                    {!! Form::hidden ('cal_consorcio', $_GET['id'], ['id' => 'cal_consorcio']) !!}
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
                        @if(Session::get('nivel')==1 && preg_match("/consorcios.edit/i", Route::currentRouteName() ))
                            <div class="m-portlet m-portlet--mobile">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">
                                                Formas de pagos
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__body">
                                        @forelse ($payments as $payment)
                                            <h5>{{ $payment->for_tipo }}</h5>
                                            <p>{{ $payment->for_información }}</p>
                                            <p>
                                                <a href="/formasdepago/{{ $payment->formasdepago_id }}/edit" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar" style="padding: .65rem 0.7rem !important">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="/formasdepago/{{ $payment->formasdepago_id }}/delete" class="btn btn-default" onclick='return confirm("Desea eliminar este registro?")' data-toggle="tooltip" data-placement="bottom" title="Eliminar" style="padding: .65rem 0.7rem !important">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </p>
                                        @empty
                                            <h5>No hay formas de pago</h5>
                                        @endforelse

                                </div>
                                <div class="m-portlet__foot">
									<div class="row align-items-center">
                                        <a href="/formasdepago/create?id={{$_id}}" class="btn m-btn--pill btn-info m-btn m-btn--custom btn-block">
                                            Nueva Forma de Pago
                                        </a>
									</div>
								</div>
                            </div>
                        @endif

                        @if(count($fotografias)>0)
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Archivos
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                    @forelse($fotografias as $key => $fotografia)
                                        <p>{{ $fotografia }}</p>
                                        <p>
                                            <a href="/envios/{{$fotografia}}" target="_blank" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar" style="padding: .65rem 0.7rem !important">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="javascript:eliminar('{{$ruta}}','{{$_id}}','{{$key}}','{{$fotografia}}');" class="btn btn-default" onclick='return confirm("Desea eliminar este archivo?")' data-toggle="tooltip" data-placement="bottom" title="Eliminar" style="padding: .65rem 0.7rem !important">
                                                <i class="fa fa-trash"></i>
                                            </a>

                                        </p>
                                    @empty
                                        <!-- <h3>No hay formas de pago</h3> -->
                                    @endforelse
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
