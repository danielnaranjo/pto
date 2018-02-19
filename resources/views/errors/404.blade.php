<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8" />
		<title>
			Error 404
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
		<link rel="shortcut icon" href="/favicon.ico" />
        <link rel="stylesheet" href="/css/paqueto.css">
        <!-- pwa -->
        <link rel="manifest" href="/manifest.json">
        <meta name="theme-color" content="#6B297E">
        <!-- pwa -->
        <style media="screen">
            p {
               color: white !important;
               font-size: 2rem !important;
               font-weight: bolder !important;
           }
        </style>
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile 		m-login m-login--1 m-login--singin" id="m_login">
				<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
					<div class="m-stack m-stack--hor m-stack--desktop">
                        <div class="m-login__wrapper">
                            <div class="m-login__logo">
                                <!-- <img src="/img/500.png" alt="Error" width="250"> -->
                            </div>
                        </div>
					</div>
				</div>
				<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content colorprincipal">
					<div class="m-grid__item m-grid__item--middle">
						<h4 class="m-login__welcome">
							Error 404
						</h4>
                        <p>
                            La dirección que estas buscando no ha sido localizada. Te ayudaremos a encontrarlo.
                        </p>
                        <p style="margin-top:50px">
                            Haz clic <a href="{{ env('APP_URL'), '/' }}" style="color:#fff !important">aquí</a> para continuar.
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
        <script type="text/javascript">
            $(function(){
                if( $( ".m-login__aside" ).find( ".alert-dismissible" ) ){
                    $('.alert-dismissible').delay(5000).fadeOut('slow');
                };
            })
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartbanner/1.0.0/jquery.smartbanner.min.js"></script>

	</body>
	<!-- end::Body -->
</html>
