@extends('layouts.app')

@section('title', $titulo)

@section('content')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<!--Begin::Main Portlet-->
				<div class="row">
                    <div class="col-xl-3">
						<div class="m-portlet m-portlet--full-height  ">
							<div class="m-portlet__body">
								<div class="m-card-profile">
									<div class="m-card-profile__title m--hide">
										Mi Perfil
									</div>
									<div class="m-card-profile__pic">
										<div class="m-card-profile__pic-wrapper">
                                            @if($results->avatar)
                                                <img src="{{$results->avatar}}" alt="{{$results->name}}">
                                            @else
			                                    <a href="#">
                                                    <img src="/pic/avatar.png" alt="">
                                                </a>
                                            @endif
										</div>
									</div>
									<div class="m-card-profile__details">
										<span class="m-card-profile__name">
											{{$results->name}}
										</span>
 										Usuario desde {{ Date::parse($results->created_at)->format('F Y') }}
									</div>
								</div>
								<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
									<li class="m-nav__separator m-nav__separator--fit"></li>
									<li class="m-nav__section m--hide">
										<span class="m-nav__section-text">
											Section
										</span>
									</li>
                                    @if($results->verified==1)
                                    <li class="m-nav__item">
										<a href="#" class="m-nav__link">
											<i class="m-nav__link-icon fa fa-check-circle-o"></i>
											<span class="m-nav__link-text">
												Usuario verificado
											</span>
										</a>
									</li>
                                    @endif
                                    @if($results->address)
									<li class="m-nav__item">
										<a href="#" class="m-nav__link">
											<i class="m-nav__link-icon fa fa-globe"></i>
											<span class="m-nav__link-text">
												Ubicación verificada
											</span>
										</a>
									</li>
                                    @endif
									<li class="m-nav__item">
										<a href="#" class="m-nav__link">
											<i class="m-nav__link-icon fa fa-id-card-o"></i>
											<span class="m-nav__link-text">
												Documentación enviada
											</span>
                                            <span class="m-nav__link-badge">
                                                <span class="m-badge m-badge--success">
                                                    1
                                                </span>
                                            </span>
										</a>
									</li>

								</ul>
								<div class="m-portlet__body-separator"></div>
							</div>
						</div>
					</div>
					<div class="col-xl-5">
                        <div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Información básica
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
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

                                {!! Form::model($results, ['method' => 'PATCH', 'action' => [$_controller.'@update', $_id], 'class'=>'m-form m-form--fit m-form--label-align-right']) !!}
                                    {!! Form::hidden ('id', $results->id, ['id' => 'id']) !!}
                                    <!-- <div class="m-portlet__body"> -->
                                        <div class="form-group m-form__group row">
                                            <div class="col-10 ml-auto">
                                                <h3 class="m-form__section">
                                                    1. Información personal
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Nombre
                                            </label>
                                            <div class="col-10">
                                                <!-- <input class="form-control m-input" type="text" name="name" value="{{ $results->name }}"> -->
                                                {!! Form::text('name', $results->name, ['class' => 'form-control m-input',  'placeholder'=>'Nombre completo', 'required' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                E-mail
                                            </label>
                                            <div class="col-10">
                                                <!-- <input class="form-control m-input" type="email" name="email" value="{{ $results->email }}"> -->
                                                {!! Form::email('email', $results->email, ['class' => 'form-control m-input',  'placeholder'=>'E-mail', 'required' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Teléfono
                                            </label>
                                            <div class="col-10">
                                                <!-- <input class="form-control m-input" type="text" name="phone" value="{{ $results->phone }}"> -->
                                                {!! Form::text('phone', $results->phone, ['class' => 'form-control m-input',  'placeholder'=>'Teléfono', 'required' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Cédula
                                            </label>
                                            <div class="col-10">
                                                <!-- <input class="form-control m-input" type="text" name="dni" value="{{ $results->dni }}"> -->
                                                {!! Form::text('dni', $results->dni, ['class' => 'form-control m-input',  'placeholder'=>'Cédula / Pasaporte / DNI', 'required' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Nacimiento
                                            </label>
                                            <div class="col-10">
                                                <!-- <input class="form-control m-input m_datetimepicker_2" type="text" name="birthdate" value="{{ $results->birthdate }}"> -->
                                                {!! Form::date('birthdate', $results->birthdate, ['class' => 'form-control m-input m_datetimepicker_2',  'placeholder'=>'Fecha de nacimiento', 'required' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Genero
                                            </label>
                                            <div class="col-10">
                                                <select class="form-control m-input" name="gender">
                                                    <option value="NA" @if($results->gender=='NA') selected @endif>No Especificado</option>
                                                    <option value="F" @if($results->gender=='F') selected @endif>Femenino</option>
                                                    <option value="M" @if($results->gender=='M') selected @endif>Masculino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-10 ml-auto">
                                                <h3 class="m-form__section">
                                                    2. Dirección
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Dirección
                                            </label>
                                            <div class="col-10">
                                                <!-- <input class="form-control m-input" type="text" name="address" value="{{ $results->address }}"> -->
                                                {!! Form::text('address', $results->address, ['class' => 'form-control m-input',  'placeholder'=>'Dirección', 'required' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Ciudad
                                            </label>
                                            <div class="col-10">
                                                <!-- <input class="form-control m-input" type="text" name="city" value="{{ $results->city }}"> -->
                                                {!! Form::text('city', $results->city, ['class' => 'form-control m-input',  'placeholder'=>'Ciudad', 'required' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Estado
                                            </label>
                                            <div class="col-10">
                                                <!-- <input class="form-control m-input" type="text" name="province" value="{{ $results->province }}"> -->
                                                {!! Form::text('province', $results->province, ['class' => 'form-control m-input',  'placeholder'=>'Estado / Provincia', 'required' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                País
                                            </label>
                                            <div class="col-10">
                                                <select class="form-control m-input" name="country">
                                                    @foreach ($countries as $country)
                                                        <option value="{{$country->country_id}}" @if($results->country==$country->country_id) selected @endif>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-10 ml-auto">
                                                <h3 class="m-form__section">
                                                    3. Documentación
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Principal
                                            </label>
                                            <div class="col-10">
                                                <div class="m-dropzone dropzone" action="/upload/{{ $_id }}" id="m-dropzone-one" multiple="multiple">
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
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Secundaria
                                            </label>
                                            <div class="col-10">
                                                <div class="m-dropzone dropzone" action="/upload/{{ $_id }}" id="m-dropzone-one" multiple="multiple">
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
                                        <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-10 ml-auto">
                                                <h3 class="m-form__section">
                                                    4. URL personalizada
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                URL
                                            </label>
                                            <div class="col-10">
                                                <input class="form-control m-input" type="text" name="slug" value="{{ $results->slug }}">
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <div class="row">
                                                <div class="col-2"></div>
                                                <div class="col-10">
                                                    {{ Form::submit('Actualizar', ['class'=>'btn btn-info m-btn--pill']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Redes Sociales
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
                                {!! Form::model($results, ['method' => 'PATCH', 'action' => [$_controller.'@create', $_id], 'class'=>'m-form m-form--fit m-form--label-align-right']) !!}
                                    {!! Form::hidden ('id', $results->id, ['id' => 'id']) !!}

                                    @foreach ($socials as $so)
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            {{ $so->name }}
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control m-input" type="text" name="{{ $so->name }}" value="{{ $so->url }}">
                                        </div>
                                    </div>
                                    @endforeach
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-10">
                                                {{ Form::submit('Guardar', ['class'=>'btn btn-info m-btn--pill']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {!! Form::close() !!}


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
			</div>
		</div>
	</div>
</div>

@component('components.modal', ['id' => 'nuevo'])
    @slot('title')
        Nueva
    @endslot
    @slot('form')
        {!! Form::open(['url' => '', 'id'=>'rrss']) !!}
        {!! Form::hidden('user_id', '0', ['id' => 'user_id']) !!}
        <div class='form-group'>
            {!! Form::label('redsocial', 'Red Social') !!}
            {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'name', 'required'=>'required']) !!}
        </div>
        <div class='form-group'>
            {!! Form::label('redsocial', 'Red Social') !!}
            {!! Form::text('url', '', ['class' => 'form-control', 'id' => 'url', 'required'=>'required']) !!}
        </div>
        {{ Form::submit('Agregar', ['class'=>'btn btn-info btn-block m-btn--pill', 'id'=>'btnNuevRRSS']) }}
        {!! Form::close() !!}
    @endslot
@endcomponent

@component('components.modal', ['id' => 'referir'])
    @slot('title')
        Referidos
    @endslot
    @slot('form')
        {!! Form::open(['url' => '', 'id'=>'referidos']) !!}
        {!! Form::hidden('user_id', '0', ['id' => 'user_id']) !!}
        <div class='form-group'>
            {!! Form::label('email', 'Destinatarios ') !!}
            {!! Form::textarea('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder'=>'daniel@correo.com.ve, esteban@hotmail.com, pepe@gmail.com', 'rows'=>'3']) !!}
            <p class="help-block">
                Si desea enviarle a uno o varios destinatarios en particular, ingrese los mails separados por coma
            </p>
        </div>
        {{ Form::submit('Enviar', ['class'=>'btn btn-info btn-block m-btn--pill', 'id'=>'btnNuevRRSS']) }}
        {!! Form::close() !!}
    @endslot
@endcomponent


@endsection
