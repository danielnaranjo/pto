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
								<div class="m-portlet__head-tools titulares">
                                    <div class="m-widget11__action m--align-right">
                                        <i class="fa fa-calendar"></i>
                                        {{ $todayis }}
                                    </div>
								</div>
							</div>
							<div class="m-portlet__body">
                                <!-- desde aqui -->
                                <!--Begin::Main Portlet-->
    							<div class="m-portlet__body  m-portlet__body--no-padding">
    								<div class="row m-row--no-padding m-row--col-separator-xl">
    									<div class="col-xl-4">
    										<!--begin:: Widgets/Stats2-1 -->
    										<div class="m-widget1">
    											<div class="m-widget1__item">
    												<div class="row m-row--no-padding align-items-center">
    													<div class="col">
    														<h3 class="m-widget1__title">
    															Envios realizados
    														</h3>
    														<span class="m-widget1__desc">
    															Este mes
    														</span>
    													</div>
    													<div class="col m--align-right">
    														<span class="m-widget1__number m--font-brand">
    															{{ $envios[0]->t or '0' }}
    														</span>
    													</div>
    												</div>
    											</div>
    											<div class="m-widget1__item">
    												<div class="row m-row--no-padding align-items-center">
    													<div class="col">
    														<h3 class="m-widget1__title">
    															Consorcios activos
    														</h3>
    														<span class="m-widget1__desc">
    															Este mes
    														</span>
    													</div>
    													<div class="col m--align-right">
    														<span class="m-widget1__number m--font-danger">
    															{{ $consorcios[0]->c or '0' }}
    														</span>
    													</div>
    												</div>
    											</div>
    											<div class="m-widget1__item">
    												<div class="row m-row--no-padding align-items-center">
    													<div class="col">
    														<h3 class="m-widget1__title">
    															Propietarios
    														</h3>
    														<!-- <span class="m-widget1__desc">
    															System bugs and issues
    														</span> -->
    													</div>
    													<div class="col m--align-right">
    														<span class="m-widget1__number m--font-success">
    															{{ $propietarios[0]->p or '0' }}
    														</span>
    													</div>
    												</div>
    											</div>
    										</div>
    										<!--end:: Widgets/Stats2-1 -->
    									</div>
    									<div class="col-xl-4">
    										<!--begin:: Widgets/Daily Sales-->
    										<div class="m-widget14">
    											<div class="m-widget14__header m--margin-bottom-30">
    												<h3 class="m-widget14__title">
    													Lectura de mensajes
    												</h3>
    												<span class="m-widget14__desc">
    													Comparativa en tiempo real
    												</span>
    											</div>
    											<div class="m-widget14__chart" style="height:120px;">
    												<canvas  id="enviados">Cargando...</canvas>
    											</div>
    										</div>
    										<!--end:: Widgets/Daily Sales-->
    									</div>
    									<div class="col-xl-4">
    										<!--begin:: Widgets/Profit Share-->
    										<div class="m-widget14">
    											<div class="m-widget14__header">
    												<h3 class="m-widget14__title">
    													Envios masivos
    												</h3>
    												<span class="m-widget14__desc">
    													Uso de plataforma
    												</span>
    											</div>
    											<div class="row  align-items-center">
    												<div class="col">
    													<div id="lecturas" class="m-widget14__chart" style="height: 160px">
    														<div class="m-widget14__stat" id="plat_total">
    															1
    														</div>
    													</div>
    												</div>
    												<div class="col">
    													<div class="m-widget14__legends">
    														<div class="m-widget14__legend">
    															<span class="m-widget14__legend-bullet m--bg-success"></span>
    															<span class="m-widget14__legend-text" id="plat_sent">
    																1% Recibidos
    															</span>
    														</div>
    														<div class="m-widget14__legend">
    															<span class="m-widget14__legend-bullet m--bg-warning"></span>
    															<span class="m-widget14__legend-text" id="plat_opened">
    																1% Abiertos
    															</span>
    														</div>
    														<div class="m-widget14__legend">
    															<span class="m-widget14__legend-bullet m--bg-danger"></span>
    															<span class="m-widget14__legend-text" id="plat_bounced">
    																1% Rechazados
    															</span>
    														</div>
    													</div>
    												</div>
    											</div>
    										</div>
    										<!--end:: Widgets/Profit Share-->
    									</div>
    								</div>
    							</div>
        						<!--End::Main Portlet-->

                                <!-- hasta aqui -->
							</div>
						</div>
						<!--end:: Widgets/Application Sales-->
					</div>
				</div>
				<!--End::Main Portlet-->
                <div class="row">
					<div class="col-xl-12">
						<!--begin:: Widgets/Application Sales-->
						<div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Ultimos envios realizados
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
                                <!-- desde aqui -->
                                <!--Begin::Main Portlet-->
                                <!--begin::Table-->
                                @if (count($results)>0)
                                <table class="table table-responsive">
                                    <!--begin::Thead-->
                                    <thead>
                                        <?php foreach ($results[0] as $key => $value) : ?>
                                            <?php $fields[] = $key; ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            @foreach ($fields as $field)
                                            @if (preg_match("/_id/i", $field))
                                            <td>
                                                #
                                            </td>
                                            @else
                                            <td class="mayusculas">
                                                {{ substr ( $field, 4, strlen($field) ) }}
                                            </td>
                                            @endif
                                            @endforeach
                                            <!-- <td>

                                            </td> -->
                                        </tr>
                                    </thead>
                                    <!--end::Thead-->
                                    <!--begin::Tbody-->
                                    <tbody>
                                        @forelse ($results as $result)
                                        <tr>
                                            @foreach ($fields as $f)
                                                <td>
                                                    @if(!preg_match("/fecha/i", $f))
                                                        {{ $result->$f }}
                                                    @else
                                                        {{ Carbon\Carbon::parse($result->$f)->format('d/m/Y') }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                            <p>No hay registros para mostrar</p>
                                        @endforelse
                                    </tbody>
                                    <!--end::Tbody-->
                                </table>
                                @else
                                    <p>No hay registros para mostrar</p>
                                @endif
                                <!--end::Table-->
        						<!--End::Main Portlet-->

                                <!-- hasta aqui -->
							</div>
						</div>
						<!--end:: Widgets/Application Sales-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
