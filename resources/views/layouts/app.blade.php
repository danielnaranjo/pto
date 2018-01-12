<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			{{ config('app.name', '') }}  | @yield('title')
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
        <link rel="stylesheet" href="/css/paqueto.css">
        <link rel="stylesheet" href="/assets/fullcalendar/fullcalendar.min.css">
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default">
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page" id="app">
			<!-- begin::Header -->
            @include('layouts.header')
            <!-- end::Header -->

            <!-- begin::Quick Sidebar -->
            @include('layouts.sidebar')
            <!-- end::Quick Sidebar -->

            <!-- begin::Body -->
            <div>
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
        <script src="{{ asset('js/manifest.js') }}"></script>
        <script src="{{ asset('js/vendor.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

		<!--begin::Base Scripts -->
		<script src="/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="/assets/demo/demo2/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->
		<!--begin::Page Snippets -->
        <!-- <script src="/assets/demo/default/custom/components/forms/widgets/summernote.js" type="text/javascript"></script>
        <script src="/assets/demo/default/custom/components/forms/widgets/dropzone.js" type="text/javascript"></script>
    	<script src="/assets/demo/default/custom/components/utils/session-timeout.js" type="text/javascript"></script>
        <script src="/assets/demo/default/custom/components/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script> -->
        <script src="/assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.es.min.js" charset="UTF-8" type="text/javascript"></script>
        <script src="/assets/demo/default/custom/components/base/toastr.js" type="text/javascript"></script>
		<!--end::Page Snippets -->

        <script src="/assets/general.js" charset="utf-8"></script>
        <!-- <script src="/assets/reporting.js" charset="utf-8"></script> -->

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

        @if(preg_match("/package.edit/i", Route::currentRouteName() ))
        <script>
            $(function(){
                //toSelect(container,value,data,keyTag,labelTag,disabled=
            });
        </script>
        @endif

        @if(preg_match( "/localhost/i", $_SERVER['SERVER_NAME']) || preg_match( "/127.0.0.1/i", $_SERVER['SERVER_NAME']))
        <script type="text/javascript">
            console.log('@result@', '{{ $results }}', '{{$_SERVER['SERVER_NAME']}}');
        </script>
        @endif
	</body>
	<!-- end::Body -->
</html>
