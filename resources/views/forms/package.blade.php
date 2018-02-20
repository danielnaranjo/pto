@extends('layouts.app')

@section('title', $titulo)

@section('content')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
                @if(preg_match("/package.create/i", Route::currentRouteName() ))
                    {!! Form::model($results, ['method' => 'POST', 'action' => 'PackageController@store' ]) !!}
                @else
                    {!! Form::model($results, ['method' => 'PATCH', 'action' => ['PackageController@update', $_id]]) !!}
                @endif

                {!! Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control', 'id' => 'user_id']) !!}
                {!! Form::hidden('tracking', Uuid::generate(), ['class' => 'form-control', 'id' => 'tracking']) !!}
				<!--Begin::Main Portlet-->
				<div class="row">
                    @if($errors->all())
                        @foreach ($errors->all() as $message)
                            @component('components.alert')
                                @slot('class')
                                    danger
                                @endslot
                                @slot('text')
                                    {{ $message }}
                                @endslot
                            @endcomponent
                        @endforeach
                    @endif

                    @if (session('status'))
                        @component('components.alert')
                            @slot('class')
                                success
                            @endslot
                            @slot('text')
                                {{ session('status') }}
                            @endslot
                        @endcomponent
                    @endif

                    <div class="col-xl-3 col-md-4">
                        <div class="m-portlet m-portlet--full-height ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Tipo de Envio
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-3 col-form-label">
                                        Tipo
                                    </label>
                                    <div class="col-9">
                                        <select class="form-control m-input" name="service_id">
                                            <option value="-1">Seleccionar</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->service_id }}" @if(preg_match("/package.edit/i", Route::currentRouteName() ) && $service->service_id==$results['service_id']) selected @endif>{{$service->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-3 col-form-label">
                                        Origen
                                    </label>
                                    <div class="col-9">
                                        <select class="form-control m-input" name="origin">
                                            <option value="-1">Seleccionar</option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->country_id}}" @if(preg_match("/package.edit/i", Route::currentRouteName() ) && $country->country_id==$results['origin']) selected @endif>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-3 col-form-label">
                                        Destino
                                    </label>
                                    <div class="col-9">
                                        <select class="form-control m-input" name="destination">
                                            <option value="-1">Seleccionar</option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->country_id}}" @if(preg_match("/package.edit/i", Route::currentRouteName() ) && $country->country_id==$results['destination']) selected @endif>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-3 col-form-label">
                                        Divisa
                                    </label>
                                    <div class="col-9">
                                        {!! Form::select('currency', ['USD' => 'USD', 'EUR' => 'EUR', 'ARS' => 'ARS', 'BSF' => 'BSF'], null, ['class' => 'form-control m-input', 'id' => 'currency']) !!}
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-3 col-form-label">
                                        Precio
                                    </label>
                                    <div class="col-9">
                                        {!! Form::text('price', null, ['class' => 'form-control m-input', 'id' => 'price', 'placeholder'=>'100']) !!}
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-3 col-form-label">
                                        Negociable
                                    </label>
                                    <div class="col-9">
                                        {!! Form::select('auction', ['N' => 'No, tarifa plana', 'Y' => 'Si, escucho ofertas'], null, ['class' => 'form-control m-input', 'id' => 'auction']) !!}
                                    </div>
                                </div>
                                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-3 col-form-label">
                                        Entrega
                                    </label>
                                    <div class="col-9">
                                        {!! Form::text('delivery', null, ['class' => 'form-control m_datetimepicker_2  m-input', 'id' => 'delivery', 'placeholder'=>'AAAA-MM-DD']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-6 col-md-6">
                        <div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Sobre el Envio
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Titulo (Uso interno)
                                        </label>
                                        <div class="col-10">
                                            {!! Form::text('title', null, ['class' => 'form-control  m-input', 'id' => 'title', 'placeholder'=> 'Titulo']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Descripción
                                        </label>
                                        <div class="col-10">
                                            {!! Form::textarea('description', null, ['class' => 'form-control summernote m-input', 'id' => 'description', 'rows'=> '10', 'placeholder'=> 'Descripción']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <div class="col-12">
                                            <p class="pull-right">
                                            @if(preg_match("/package.edit/i", Route::currentRouteName() ))
                                            {{ Form::submit('Actualizar', ['class'=>'btn btn-info m-btn--pill btn-block']) }}
                                            @else
                                            {{ Form::submit('Publicar envio', ['class'=>'btn btn-info m-btn--pill btn-block']) }}
                                            @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-2">
                        <div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Fotografias
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
                                <div class="m-widget6">
                                    <div class="m-dropzone dropzone" action="/package/upload/@if(preg_match("/package.edit/i", Route::currentRouteName() )){{ $_id }}@endif" id="m-dropzone-two" multiple="multiple" @if(preg_match("/package.create/i", Route::currentRouteName() ))  style="pointer-events:none;cursor:default;" @endif>
                                        <div class="m-dropzone__msg dz-message needsclick">
                                            <h3 class="m-dropzone__msg-title">
                                                Arrastra el archivo o haz clic aqui para subirlo
                                            </h3>
                                            <span class="m-dropzone__msg-desc">
                                                Formatos soportados: JPG, GIF, PNG
                                            </span>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
                    </div>
                    <div class="col-xl-12">
                        <p>
                            <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="/travel">
                                Volver atras
                            </a>
                        </p>
                    </div>

				</div>
				<!--End::Main Portlet-->
                {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection
