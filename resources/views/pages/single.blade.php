@extends('layouts.app')

@section('title', $titulo)

@section('content')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<!--Begin::Main Portlet-->
				<div class="row">
					<div class="col-xl-7">
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
							</div>
							<div class="m-portlet__body">
								<div class="tab-content">
									<!--begin::Widget 11-->
									<div class="m-widget6">
										<div class="table-responsive">
                                            <h5>Comentarios</h5>
                                            <p>
                                                {{ $comment[0]->com_consulta }}
                                            </p>
                                            <p>
                                                Fecha: {{ Carbon\Carbon::parse($comment[0]->com_fecha)->format('d/m/Y H:i') }}
                                            </p>
										</div>
									</div>
									<!--end::Widget 11-->
								</div>
							</div>
						</div>
						<!--end:: Widgets/Application Sales-->
					</div>
                    <div class="col-xl-5">
                        <div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Información
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="tab-content">
									<!--begin::Widget 11-->
									<div class="m-widget6">
										<div class="table-responsive">
                                            <h5>Propietario</h5>
											<p>
                                                Propietario: {{ $comment[0]->com_propietario }} <br>
                                                Departamento: {{ $comment[0]->com_departamento }}
                                            </p>
                                            <p>
                                                E-mail:
                                                <a class="" href="mailto:{{ $comment[0]->com_email }}">
                                                    {{ $comment[0]->com_email }}
                                                </a>
                                                <br>
                                                Telefono:
                                                <a class="" href="tel:{{ $comment[0]->com_telefono }}">
                                                    {{ $comment[0]->com_telefono }}
                                                </a>
                                            </p>
                                            <h5>Consorcio</h5>
											<p>
                                                Consorcio: {{ $comment[0]->con_nombre }} <br>
                                            </p>
                                            <p>
                                                Dirección:
                                                <a class="" href="mailto:{{ $comment[0]->com_email }}">
                                                    {{ $comment[0]->con_direccion }}
                                                </a>
                                                <br>
                                                Encargado:
                                                <a class="" href="tel:{{ $comment[0]->com_telefono }}">
                                                    {{ $comment[0]->con_encargado }}
                                                </a>
                                            </p>
										</div>
									</div>
									<!--end::Widget 11-->
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-xl-12">
                        <p>
                            <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom" href="{{ url()->previous() }}">
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
@endsection
