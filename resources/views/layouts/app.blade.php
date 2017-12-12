<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			@yield('title') | {{ config('app.name', '') }}
		</title>
		<meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
		<link href="/assets/demo/demo2/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="/assets/demo/demo2/media/img/logo/favicon.ico" />
        <link rel="stylesheet" href="/css/tuconsorcio.css">
        <link rel="stylesheet" href="/assets/fullcalendar/fullcalendar.min.css">
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default">
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- begin::Header -->

            <header class="m-grid__item		m-header "  data-minimize="minimize" data-minimize-offset="200" data-minimize-mobile-offset="200" >
                <div class="m-header__top">
                    <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                        <div class="m-stack m-stack--ver m-stack--desktop">
                            <!-- begin::Brand -->
                            <div class="m-stack__item m-brand">
                                <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                        <a href="/" class="m-brand__logo-wrapper">
                                            <img alt="loho" src="/img/logo-01.png" class="logo" />
                                        </a>
                                    </div>
                                    <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                        <!-- begin::Responsive Header Menu Toggler-->
                                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                            <span></span>
                                        </a>
                                        <!-- end::Responsive Header Menu Toggler-->
                                        <!-- begin::Topbar Toggler-->
                                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                            <i class="flaticon-more"></i>
                                        </a>
                                        <!--end::Topbar Toggler-->
                                    </div>
                                </div>
                            </div>
                            <!-- end::Brand -->

                            <!-- begin::Topbar -->
                            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                                    <div class="m-stack__item m-topbar__nav-wrapper">
                                        <ul class="m-topbar__nav m-nav m-nav--inline">
                                            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
                                                <a href="javascript:;" class="m-nav__link m-dropdown__toggle">
                                                    <span class="m-topbar__userpic m--hide">
                                                        <!-- <img src="/assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt=""/> -->
                                                    </span>
                                                    <span class="m-topbar__welcome">
                                                        Hola,&nbsp;
                                                    </span>
                                                    <span class="m-topbar__username">
                                                        {{ Auth::user()->name or "" }}
                                                    </span>
                                                </a>
                                                <div class="m-dropdown__wrapper">
                                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="color:white !important"></span>
                                                    <div class="m-dropdown__inner">
                                                        <div class="m-dropdown__header m--align-center colorprincipal">
                                                            <div class="m-card-user m-card-user--skin-dark">
                                                                <div class="m-card-user__details">
                                                                    <span class="m-card-user__name m--font-weight-500">
                                                                        {{ Auth::user()->name or "" }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-dropdown__body">
                                                            <div class="m-dropdown__content">
                                                                <ul class="m-nav m-nav--skin-light">
                                                                    <li class="m-nav__section m--hide">
                                                                        <span class="m-nav__section-text">
                                                                            Section
                                                                        </span>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="/inmobiliarias/{{ Session::get('inmobiliaria')->inm_id }}/edit" class="m-nav__link">
                                                                            <i class="m-nav__link-icon fa fa-pencil"></i>
                                                                            <span class="m-nav__link-title">
                                                                                <span class="m-nav__link-wrap">
                                                                                    <span class="m-nav__link-text">
                                                                                        Editar Información
                                                                                    </span>
                                                                                </span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true">
                                                <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
                                                    <span class="m-nav__link-icon">
                                                        <span class="m-nav__link-icon-wrapper">
                                                            <i class="flaticon-music-2"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                                <div class="m-dropdown__wrapper">
                                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                                    <div class="m-dropdown__inner">
                                                        <div class="m-dropdown__header m--align-center colorprincipal">
                                                            <span class="m-dropdown__header-title">
                                                                Notificaciones
                                                            </span>
                                                        </div>
                                                        <div class="m-dropdown__body">
                                                            <div class="m-dropdown__content">
                                                                <div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
                                                                    <div class="m-list-timeline m-list-timeline--skin-light">
                                                                        <div class="m-list-timeline__items">
                                                                            @include('components.timeline')
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="m-nav__item" >
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();" class="m-nav__link">
                                                    <span class="m-nav__link-badge"></span>
                                                    <span class="m-nav__link-icon">
                                                        <span class="m-nav__link-icon-wrapper">
                                                            <i class="flaticon-logout"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                            <!-- menu rapido -->
                                            <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"  data-dropdown-toggle="click">
                                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
                                                    <span class="m-nav__link-icon">
                                                        <span class="m-nav__link-icon-wrapper">
                                                            <i class="flaticon-share"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                                @include('layouts.quick')
                                            </li>
                                            <!-- menu rapido -->
                                            <li id="m_quick_sidebar_toggle" class="m-nav__item" style="display:none">
            									<a href="#" class="m-nav__link m-dropdown__toggle">
            										<span class="m-nav__link-icon m-nav__link-icon--aside-toggle">
            											<span class="m-nav__link-icon-wrapper">
            												<i class="flaticon-grid-menu"></i>
            											</span>
            										</span>
            									</a>
            								</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- end::Topbar -->
                        </div>
                    </div>
                </div>
                <div class="m-header__bottom">
                    <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                        <div class="m-stack m-stack--ver m-stack--desktop">
                            <!-- begin::Horizontal Menu -->
                            <div class="m-stack__item m-stack__item--middle m-stack__item--fluid">
                                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
                                    <i class="la la-close"></i>
                                </button>
                                <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "  >
                                    @include('menus.general')
                                </div>
                            </div>
                            <!-- end::Horizontal Menu -->

                            <!--begin::Search-->
                            @include('layouts.search')
                            <!--end::Search-->
                        </div>
                    </div>
                </div>
            </header>

			<!-- end::Header -->

            <!-- begin::Quick Sidebar -->
            @include('layouts.sidebar')
            <!-- end::Quick Sidebar -->

            <!-- begin::Body -->
            <div id="app">
                @yield('content')
            </div>
            <!-- end::Body -->

			<!-- begin::Footer -->
			@include('layouts.footer')
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->

		<!-- begin::Scroll Top -->
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->

        <!-- <script src="/js/app.js"></script> -->
        <script src="{{ asset('js/app.js') }}"></script>

		<!--begin::Base Scripts -->
		<script src="/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="/assets/demo/demo2/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->
		<!--begin::Page Snippets -->
        <script src="/assets/demo/default/custom/components/forms/widgets/summernote.js" type="text/javascript"></script>
        <script src="/assets/demo/default/custom/components/forms/widgets/dropzone.js" type="text/javascript"></script>
    	<script src="/assets/demo/default/custom/components/utils/session-timeout.js" type="text/javascript"></script>
        <script src="/assets/demo/default/custom/components/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
        <script src="/assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.es.min.js" charset="UTF-8" type="text/javascript"></script>
        <script src="/assets/demo/default/custom/components/base/toastr.js" type="text/javascript"></script>
		<!--end::Page Snippets -->

        <script src="/assets/general.js" charset="utf-8"></script>
        <script src="/assets/reporting.js" charset="utf-8"></script>

        @if(preg_match( "/dashboard/i", $_SERVER['REQUEST_URI']) || preg_match( "/principal/i", $_SERVER['REQUEST_URI']))
        <script src="/assets/chartManager.js" charset="utf-8"></script>
        <script>
            // Graficos personalizados
            var labels = [@foreach($stats as $stat) '{{Carbon\Carbon::parse($stat->env_fechaenvio)->format("d/m/Y")}}', @endforeach];
            var values = [@foreach($stats as $stat) {{$stat->t}}, @endforeach];
            var series = [{{ $mailgun['total'] }},{{ $mailgun['sent'] }},{{ $mailgun['opened'] }},{{ $mailgun['bounced'] }}];
            $(function(){
                graficosEnvios(labels,values,'enviados');
                graficosLecturas(series, 'lecturas');
            });
        </script>
        @endif

        @if(preg_match( "/calendario/i", $_SERVER['REQUEST_URI']))
        <script src="/assets/fullcalendar/fullcalendar.min.js" charset="utf-8"></script>
        <script src="/assets/fullcalendar/locale-all.js" charset="utf-8"></script>
        <script>
            var data = <?=json_encode($results)?>;
            getCalendar(data);
        </script>
        <!-- alertas -->
        @component('components.modal', ['id' => 'calendario'])
            @slot('title')
                Calendario de Actividades
            @endslot
            @slot('form')
            @endslot
        @endcomponent
        @endif

        @if(preg_match("/consorcios.edit/i", Route::currentRouteName() ))
        <script>
            $(function(){
                toSelect('con_localidad',1,<?=$localidad?>,'loc_id','loc_nombre');
                toSelect('con_inmobiliaria',1,<?=$inmobiliaria?>,'inm_id','inm_nombre',@if(Session::has('inmobiliaria')) true @endif);
            });
        </script>
        @endif

        <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
        <script>
            var pusher = new Pusher('9494a97e796d153cd2b7', {
                cluster: 'us2',
                encrypted: true
            });
            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                toastr.info(data.message,'Notificaciones en Tiempo Real');
                @if(preg_match( "/localhost/i", $_SERVER['SERVER_NAME']))
                alert(data.message);
                @endif
            });
            channel.bind('connected', function(states) {
                // states = {previous: 'oldState', current: 'newState'}
                toastr.info("Conectado");
            });
            channel.bind('connecting_in', function(delay) {
                alert("I haven't been able to establish a connection for this feature.  " +
                    "I will try again in " + delay + " seconds.")
            });
        </script>

        @if(preg_match( "/localhost/i", $_SERVER['SERVER_NAME']) || preg_match( "/127.0.0.1/i", $_SERVER['SERVER_NAME']))
        <script type="text/javascript">
            console.log('result', '{{$results}}', '{{$_SERVER['SERVER_NAME']}}');
            Pusher.logToConsole = true;
        </script>
        @endif
	</body>
	<!-- end::Body -->
</html>
