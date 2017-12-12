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
							</div>
							<div class="m-portlet__body">
                                <div class="row">
                                    @forelse ($results as $result)
                					<div class="col-xl-4">
                                        <div class="m-portlet m-portlet--mobile">
        									<div class="m-portlet__head">
        										<div class="m-portlet__head-caption">
        											<div class="m-portlet__head-title">
        												<h3 class="m-portlet__head-text">
        													{{$result->doc_nombre}}
        												</h3>
        											</div>
        										</div>
        									</div>
        									<div class="m-portlet__body">
                                                @if($result->doc_arch1)
                                                    <i class="fa fa-file-o"></i>
                                                    <a href="/documentos/{{$result->doc_arch1}}" target="_blank"> {{$result->doc_arch1}}</a><br>
                                                @endif
                                                @if($result->doc_arch2)
                                                    <i class="fa fa-file-o"></i>
                                                    <a href="/documentos/{{$result->doc_arch2}}" target="_blank"> {{$result->doc_arch2}}</a><br>
                                                @endif
                                                @if($result->doc_arch3)
                                                     <i class="fa fa-file-o"></i>
                                                    <a href="/documentos/{{$result->doc_arch3}}" target="_blank"> {{$result->doc_arch3}}</a><br>
                                                @endif
                                                @if($result->doc_arch4)
                                                    <i class="fa fa-file-o"></i>
                                                    <a href="/documentos/{{$result->doc_arch4}}" target="_blank"> {{$result->doc_arch4}}</a><br>
                                                @endif

        									</div>
        								</div>
                                    </div>
                                    @empty
                                        <h5>
                                            No hay documentos disponibles
                                        </h5>
                                    @endforelse
    							</div>
							</div>
						</div>
						<!--end:: Widgets/Application Sales-->
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
