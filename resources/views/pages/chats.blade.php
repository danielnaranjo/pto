@extends('layouts.app')

@section('title', $titulo)

@section('content')

<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
                <!--Begin::Main Portlet-->
                <div class="row">
                    <div class="col-xl-12">
                        <!--begin:: Widgets/Application Sales-->
                        <div class="m-portlet m-portlet--full-height ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            {{ $titulo }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <!-- <ul class="nav nav-pills nav-pills--info m-nav-pills--align-right m-nav-pills--btn-pill">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active" href="/travel/create">
												Agregar mi viaje
											</a>
										</li>
									</ul> -->
								</div>
                            </div>
                        </div>
                        <!--end:: Widgets/Application Sales-->
                    </div>
                </div>
                <!--End::Main Portlet-->
				<!--Begin::Main Portlet-->
				<div class="row">
                    <div class="col-xl-3">
                        <create-group :initial-users="{{ $users }}"></create-group>
                    </div>
                    <div class="col-xl-9">
                        <groups :initial-groups="{{ $groups }}" :user="{{ $user}}"></groups>
                    </div>
                </div>
                <!--End::Main Portlet-->
                <div class="col-xl-12">
                    {{-- json_encode($groups) --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
