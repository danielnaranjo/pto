@extends('layouts.app')

@section('title', $titulo)

@section('content')

<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver m-container m-container--responsive m-container--xxl m-page__container">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<!--Begin::Main Portlet-->
				<div class="row">
					<div class="col-md-12 col-xl-12">
						<!--begin:: Widgets/Application Sales-->
						<div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											<strong>{{$titulo}}</strong>
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
                                    <div class="m-widget11__action m--align-right">
                                        <!-- <a href="/package/create" class="btn m-btn--pill btn-secondary m-btn m-btn--custom">
                                            Nuevo Envio
                                        </a> -->
                                        {{-- $rutaactual --}}
                                        {{-- Route::currentRouteName() --}}
                                        {{-- url()->current() --}}
                                    </div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="tab-content">
									<!--begin::Widget 11-->
									<div class="m-widget11">

                                        @if (session('status'))
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{ session('status') }}
                                            </div>
                                        @endif

										<div class="table-responsive">
											<!--begin::Table-->
                                            @if (count($results)>0)
                                            <table class="table">
                                                <!--begin::Thead-->
                                                <thead>
                                                    <tr>
                                                        <td class="mayusculas">
                                                            Fecha
                                                        </td>
                                                        <td class="mayusculas">
                                                            De
                                                        </td>
                                                        <td class="mayusculas">
                                                            Escribió
                                                        </td>
                                                        <td class="mayusculas">

                                                        </td>
                                                    </tr>
                                                </thead>
                                                <!--end::Thead-->
                                                <!--begin::Tbody-->
                                                <tbody>
                                                    @forelse ($results as $result)
                                                    <tr>
                                                        <td class="mayusculas">
                                                            {{ Date::parse($result->createdAt)->format('d/m/Y') }}
                                                        </td>
                                                        <td class="mayusculas">
                                                            {{$result->from->name}}
                                                        </td>
                                                        <td class="mayusculas">
                                                            {{$result->comment}}
                                                        </td>
                                                        <td class="opciones">
                                                            <!-- <a href="/travel/{{ $result->travel_id }}/edit" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="javascript:borrar('travel',{{ $result->travel_id }});" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                                                                <i class="fa fa-trash"></i>
                                                            </a> -->
                                                        </td>
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
                                            <p>
                                                {{ $results->links() }}
                                            </p>
											<!--end::Table-->
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
