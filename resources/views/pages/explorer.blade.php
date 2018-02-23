@extends('layouts.app')

@section('title', '$titulo')

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
											{{$titulo or ''}}
										</h3>
									</div>
								</div>
								<!-- <div class="m-portlet__head-tools titulares">
                                    <div class="m-widget11__action m--align-right">
                                        <i class="fa fa-calendar"></i>
                                    </div>
								</div> -->
							</div>
						</div>
						<!--end:: Widgets/Application Sales-->
					</div>
				</div>
				<!--End::Main Portlet-->
                <div class="row">
                    @forelse ($results as $travel)
                    <div class="col-xl-3">
                        <!--begin:: Widgets/Announcements 1-->
                        <div class="m-portlet m--bg-accent m-portlet--bordered-semi m-portlet--skin-dark m-portlet--full-height ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Viajando desde
                                            {{ $travel->from->name or 'No disponible' }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="m-portlet__nav">
                                        <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover">
                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
                                                <i class="la la-ellipsis-h m--font-light"></i>
                                            </a>
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content">
                                                            <ul class="m-nav">
                                                                <li class="m-nav__section m-nav__section--first">
                                                                    <span class="m-nav__section-text">
                                                                        Compartir en:
                                                                    </span>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="" class="m-nav__link">
                                                                        <i class="m-nav__link-icon fa fa-facebook-official"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Facebook
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="" class="m-nav__link">
                                                                        <i class="m-nav__link-icon fa fa-google-plus"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Google+
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="" class="m-nav__link">
                                                                        <i class="m-nav__link-icon fa fa-instagram"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Instagram
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="" class="m-nav__link">
                                                                        <i class="m-nav__link-icon fa fa-twitter"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Twitter
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <!--begin::Widget 7-->
                                <div class="m-widget7 m-widget7--skin-dark">
                                    <div class="m-widget7__desc">
                                        Tengo disponible
                                        @if($travel->weight)
                                            <span class="destacar" data-toggle="tooltip" data-placement="bottom" title="Peso establecido">{{ $travel->weight }}</span>
                                        @endif
                                        @if($travel->dimensions)
                                            para llevar <span class="destacar" data-toggle="tooltip" data-placement="bottom" title="Tamaño permitido">{{ $travel->dimensions }}</span>
                                        @endif
                                        @if($travel->restrictions)
                                            pero no llevo <span class="destacar" data-toggle="tooltip" data-placement="bottom" title="Articulos prohibidos">{!! $travel->restrictions !!}</span>
                                        @endif
                                    </div>
                                    <div class="m-widget7__user">
                                        <div class="m-widget7__user-img">
                                            <!-- <img class="m-widget7__img" src="/assets/app/media/img//users/100_3.jpg" alt=""> -->
                                            @if($travel->user->avatar)
                                                <img src="{{$travel->user->avatar}}" alt="{{$travel->user->name}}" class="m-widget7__img" >
                                            @else
                                                <img src="/pic/avatar.png" alt="avatar" class="m-widget7__img" >
                                            @endif
                                        </div>
                                        <div class="m-widget7__info">
                                            <span class="m-widget7__username">
                                                {{ $travel->user->name }}
                                            </span>
                                            <br>
                                            <span class="m-widget7__time">
                                                {{ Date::parse($travel->date)->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="m-widget7__button">
                                        <a class="m-btn m-btn--pill btn btn-info" href="/u/{{ $travel->user->slug }}" role="button">
                                            Contactar
                                        </a>
                                    </div>
                                </div>
                                <!--end::Widget 7-->
                            </div>
                        </div>
                        <!--end:: Widgets/Announcements 1-->
                    </div>
                    @empty
                    <div class="col-xl-4">
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Lo sentimos
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                No hay viajeros disponibles
                            </div>
                        </div>
                    </div>
                    @endforelse
                    <div class="col-xl-12">
                        {{ $results->links() }}
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
