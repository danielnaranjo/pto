@extends('layouts.app')

@section('title', $titulo or 'Vista General')

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
											{{$titulo or 'Vista General'}}
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools titulares">
                                    <div class="m-widget11__action m--align-right">
                                        <i class="fa fa-calendar"></i>
                                        {{ $todayis or '' }}
                                    </div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Application Sales-->
					</div>
				</div>
				<!--End::Main Portlet-->
                <div class="row">
                    <div class="col-xl-4" style="display:none;">
						<!--begin:: Widgets/Activity-->
						<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text m--font-light">
											Actividad
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="m-widget17">
									<div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
										<div class="m-widget17__chart" style="height:320px;"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
											<canvas id="m_chart_activities" width="403" height="208" style="display: block; width: 403px; height: 208px;"></canvas>
										</div>
									</div>
									<div class="m-widget17__stats">
										<div class="m-widget17__items m-widget17__items-col1">
											<div class="m-widget17__item">
												<span class="m-widget17__icon">
													<i class="flaticon-truck m--font-brand"></i>
												</span>
												<span class="m-widget17__subtitle">
													Delivered
												</span>
												<span class="m-widget17__desc">
													15 New Paskages
												</span>
											</div>
											<div class="m-widget17__item">
												<span class="m-widget17__icon">
													<i class="flaticon-paper-plane m--font-info"></i>
												</span>
												<span class="m-widget17__subtitle">
													Reporeted
												</span>
												<span class="m-widget17__desc">
													72 Support Cases
												</span>
											</div>
										</div>
										<div class="m-widget17__items m-widget17__items-col2">
											<div class="m-widget17__item">
												<span class="m-widget17__icon">
													<i class="flaticon-pie-chart m--font-success"></i>
												</span>
												<span class="m-widget17__subtitle">
													Ordered
												</span>
												<span class="m-widget17__desc">
													72 New Items
												</span>
											</div>
											<div class="m-widget17__item">
												<span class="m-widget17__icon">
													<i class="flaticon-time m--font-danger"></i>
												</span>
												<span class="m-widget17__subtitle">
													Arrived
												</span>
												<span class="m-widget17__desc">
													34 Upgraded Boxes
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Activity-->
					</div>
                    <div class="col-xl-4">
                        <!--begin:: Widgets/Announcements 1-->
                        <div class="m-portlet m--bg-accent m-portlet--bordered-semi m-portlet--skin-dark m-portlet--full-height ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Redes Sociales
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
                                                                        Siguenos en:
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
                                        Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy euismod tinciduntut laoreet doloremagna
                                    </div>
                                    <div class="m-widget7__user">
                                        <div class="m-widget7__user-img">
                                            <img class="m-widget7__img" src="assets/app/media/img//users/100_3.jpg" alt="">
                                        </div>
                                        <div class="m-widget7__info">
                                            <span class="m-widget7__username">
                                                Dan Bold
                                            </span>
                                            <br>
                                            <span class="m-widget7__time">
                                                3 days ago
                                            </span>
                                        </div>
                                    </div>
                                    <div class="m-widget7__button">
                                        <a class="m-btn m-btn--pill btn btn-danger" href="#" role="button">
                                            All Feeds
                                        </a>
                                    </div>
                                </div>
                                <!--end::Widget 7-->
                            </div>
                        </div>
                        <!--end:: Widgets/Announcements 1-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin:: Widgets/Blog-->
                        <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                            <div class="m-portlet__head m-portlet__head--fit">
                                <div class="m-portlet__head-caption">
                                    <!-- <div class="m-portlet__head-action">
                                        <button type="button" class="btn btn-sm m-btn--pill  btn-brand">
                                            Blog
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="m-widget19">
                                    <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
                                        <img src="assets/app/media/img//blog/blog1.jpg" alt="">
                                        <h3 class="m-widget19__title m--font-light">
                                            Introducing New Feature
                                        </h3>
                                        <div class="m-widget19__shadow"></div>
                                    </div>
                                    <div class="m-widget19__content">
                                        <div class="m-widget19__header">
                                            <div class="m-widget19__user-img">
                                                <img class="m-widget19__img" src="assets/app/media/img//users/user1.jpg" alt="">
                                            </div>
                                            <div class="m-widget19__info">
                                                <span class="m-widget19__username">
                                                    Anna Krox
                                                </span>
                                                <br>
                                                <span class="m-widget19__time">
                                                    UX/UI Designer, Google
                                                </span>
                                            </div>
                                            <div class="m-widget19__stats">
                                                <span class="m-widget19__number m--font-brand">
                                                    18
                                                </span>
                                                <span class="m-widget19__comment">
                                                    Comments
                                                </span>
                                            </div>
                                        </div>
                                        <div class="m-widget19__body">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry scrambled it to make text of the printing and typesetting industry scrambled a type specimen book text of the dummy text of the printing printing and typesetting industry scrambled dummy text of the printing.
                                            {{ Auth::user()->name }}
                                        </div>
                                    </div>
                                    <div class="m-widget19__action">
                                        <button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">
                                            Read More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Blog-->
                    </div>
                    <div class="col-xl-4">
						<!--begin:: Widgets/New Users-->
						<div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Nuevos usuarios
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
									<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget4_tab1_content" role="tab">
												Hoy
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab2_content" role="tab">
												Este mes
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="tab-content">
									<div class="tab-pane active" id="m_widget4_tab1_content">
										<!--begin::Widget 14-->
										<div class="m-widget4">
											<!--begin::Widget 14 Item-->
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--pic">
													<img src="assets/app/media/img/users/100_4.jpg" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Anna Strong
													</span>
													<br>
													<span class="m-widget4__sub">
														Visual Designer,Google Inc
													</span>
												</div>
												<div class="m-widget4__ext">
													<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
														Follow
													</a>
												</div>
											</div>
											<!--end::Widget 14 Item-->
											<!--begin::Widget 14 Item-->
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--pic">
													<img src="assets/app/media/img/users/100_14.jpg" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Milano Esco
													</span>
													<br>
													<span class="m-widget4__sub">
														Product Designer, Apple Inc
													</span>
												</div>
												<div class="m-widget4__ext">
													<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
														Follow
													</a>
												</div>
											</div>
											<!--end::Widget 14 Item-->
											<!--begin::Widget 14 Item-->
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--pic">
													<img src="assets/app/media/img/users/100_11.jpg" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Nick Bold
													</span>
													<br>
													<span class="m-widget4__sub">
														Web Developer, Facebook Inc
													</span>
												</div>
												<div class="m-widget4__ext">
													<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
														Follow
													</a>
												</div>
											</div>
											<!--end::Widget 14 Item-->
											<!--begin::Widget 14 Item-->
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--pic">
													<img src="assets/app/media/img/users/100_1.jpg" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Wiltor Delton
													</span>
													<br>
													<span class="m-widget4__sub">
														Project Manager, Amazon Inc
													</span>
												</div>
												<div class="m-widget4__ext">
													<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
														Follow
													</a>
												</div>
											</div>
											<!--end::Widget 14 Item-->
											<!--begin::Widget 14 Item-->
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--pic">
													<img src="assets/app/media/img/users/100_5.jpg" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Nick Stone
													</span>
													<br>
													<span class="m-widget4__sub">
														Visual Designer, Github Inc
													</span>
												</div>
												<div class="m-widget4__ext">
													<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
														Follow
													</a>
												</div>
											</div>
											<!--end::Widget 14 Item-->
										</div>
										<!--end::Widget 14-->
									</div>
									<div class="tab-pane" id="m_widget4_tab2_content">
										<!--begin::Widget 14-->
										<div class="m-widget4">
											<!--begin::Widget 14 Item-->
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--pic">
													<img src="assets/app/media/img/users/100_2.jpg" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Kristika Bold
													</span>
													<br>
													<span class="m-widget4__sub">
														Product Designer,Apple Inc
													</span>
												</div>
												<div class="m-widget4__ext">
													<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
														Follow
													</a>
												</div>
											</div>
											<!--end::Widget 14 Item-->
											<!--begin::Widget 14 Item-->
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--pic">
													<img src="assets/app/media/img/users/100_13.jpg" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Ron Silk
													</span>
													<br>
													<span class="m-widget4__sub">
														Release Manager, Loop Inc
													</span>
												</div>
												<div class="m-widget4__ext">
													<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
														Follow
													</a>
												</div>
											</div>
											<!--end::Widget 14 Item-->
											<!--begin::Widget 14 Item-->
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--pic">
													<img src="assets/app/media/img/users/100_9.jpg" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Nick Bold
													</span>
													<br>
													<span class="m-widget4__sub">
														Web Developer, Facebook Inc
													</span>
												</div>
												<div class="m-widget4__ext">
													<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
														Follow
													</a>
												</div>
											</div>
											<!--end::Widget 14 Item-->
											<!--begin::Widget 14 Item-->
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--pic">
													<img src="assets/app/media/img/users/100_2.jpg" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Wiltor Delton
													</span>
													<br>
													<span class="m-widget4__sub">
														Project Manager, Amazon Inc
													</span>
												</div>
												<div class="m-widget4__ext">
													<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
														Follow
													</a>
												</div>
											</div>
											<!--end::Widget 14 Item-->
											<!--end::Widget 14 Item-->
											<!--begin::Widget 14 Item-->
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--pic">
													<img src="assets/app/media/img/users/100_8.jpg" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Nick Bold
													</span>
													<br>
													<span class="m-widget4__sub">
														Web Developer, Facebook Inc
													</span>
												</div>
												<div class="m-widget4__ext">
													<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
														Follow
													</a>
												</div>
											</div>
											<!--end::Widget 14 Item-->
										</div>
										<!--end::Widget 14-->
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/New Users-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection