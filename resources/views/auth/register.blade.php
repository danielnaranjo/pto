<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8" />
		<title>
			{{ config('app.name', 'Laravel') }}
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
		<!--begin::Base Styles -->
		<link href="/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="/assets/demo/default/media/img/logo/favicon.ico" />
        <link rel="stylesheet" href="/css/paqueto.css">
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile 		m-login m-login--1 m-login--singin" id="m_login">
				<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
					<div class="m-stack m-stack--hor m-stack--desktop">
						<div class="m-stack__item m-stack__item--fluid">
							<div class="m-login__wrapper">
								<div class="m-login__signin">
									<div class="m-login__head">
										<h3 class="m-login__title">
											Nuevo usuario
										</h3>
									</div>
                                    {!! Form::open(['route' => 'register', 'class' => 'm-login__form m-form ']) !!}
										<div class="form-group m-form__group{{ $errors->has('email') ? ' has-error' : '' }}">
											<input class="form-control m-input" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="E-mail" >
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
										</div>
										<div class="form-group m-form__group{{ $errors->has('password') ? ' has-error' : '' }}">
											<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Contraseña" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
										</div>
                                        <div class="form-group m-form__group{{ $errors->has('password') ? ' has-error' : '' }}">
											<input class="form-control m-input m-login__form-input--last" placeholder="Confirmar contraseña" id="password-confirm" type="password" name="password_confirmation" required>
										</div>

										<div class="m-login__form-action">
											<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
												Registrarme
											</button>
										</div>
                                    {!! Form::close() !!}
								</div>
							</div>
						</div>
                        <div class="m-stack__item m-stack__item--center">
							<div class="m-login__account">
                                <span class="m-login__account-msg">
									Ya tengo una cuenta creada, Haz clic
								</span>
								<a href="{{ route('login') }}" class="m-link m-link--focus m-login__account-link">
									aquí
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content colorprincipal">
					<div class="m-grid__item m-grid__item--middle">
						<h3 class="m-login__welcome">
							Sé parte de nuestra comunidad
						</h3>
						<p class="m-login__msg">
							Viaja ganando dinero.
						</p>
					</div>
				</div>
			</div>
		</div>
		<!--begin::Base Scripts -->
		<script src="/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->
		<!--begin::Page Snippets -->
		<script src="/assets/snippets/pages/user/login.js" type="text/javascript"></script>
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>
