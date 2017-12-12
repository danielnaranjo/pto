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
											{{$titulo}}
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
                                    <div class="m-widget11__action m--align-right">
                                        <!-- <button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--hover-brand">
                                            Generar Reporte
                                        </button> -->
                                    </div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="tab-content">
									<!--begin::Widget 11-->
									<div class="m-widget11">
										<div class="table-responsive">
											<!--begin::calendar-->
                                            <div id='calendar'></div>
											<!--end::calendar-->
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
@endsection
