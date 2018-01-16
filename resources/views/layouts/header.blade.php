@if(!Auth::check())
    <script type="text/javascript">window.location = "/"; </script>
@endif
<header class="m-grid__item		m-header "  data-minimize="minimize" data-minimize-offset="200" data-minimize-mobile-offset="200" >
    <div class="m-header__top">
        <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <!-- begin::Brand -->
                <div class="m-stack__item m-brand">
                    <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="/" class="m-brand__logo-wrapper">
                                <!-- <img alt="loho" src="/img/logo-01.png" class="logo" /> -->
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
                                            @if (Auth::check())
                                                {{ Auth::user()->name }}
                                            @endif
                                        </span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="color:#368ee0 !important"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center colorprincipal">
                                                <div class="m-card-user m-card-user--skin-dark">
                                                    <div class="m-card-user__details">
                                                        <span class="m-card-user__name m--font-weight-500">
                                                            Opciones
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
                                                            <a href="/user/{{ Auth::user()->id }}/edit" class="m-nav__link">
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
                                                        <li class="m-nav__item">
                                                            <a href="/user/message/{{ Auth::user()->id }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon fa fa-comments-o"></i>
                                                                <span class="m-nav__link-title">
                                                                    <span class="m-nav__link-wrap">
                                                                        <span class="m-nav__link-text">
                                                                            Conversaciones
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                        				</li>
                                                        <!-- <li class="m-nav__item">
                                                            <a href="/user/message/{{ Auth::user()->id }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon fa fa-money"></i>
                                                                <span class="m-nav__link-title">
                                                                    <span class="m-nav__link-wrap">
                                                                        <span class="m-nav__link-text">
                                                                        	Pagos recibidos
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                        				</li> -->
                                                        <li class="m-nav__item">
                                                            <a href="/user/package/{{ Auth::user()->id }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon fa fa-truck"></i>
                                                                <span class="m-nav__link-title">
                                                                    <span class="m-nav__link-wrap">
                                                                        <span class="m-nav__link-text">
                                                                            Paquetes enviados
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                        				</li>
                                                        <li class="m-nav__item">
                                                            <a href="/user/travel/{{ Auth::user()->id }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon fa fa-plane"></i>
                                                                <span class="m-nav__link-title">
                                                                    <span class="m-nav__link-wrap">
                                                                        <span class="m-nav__link-text">
                                                                            	Viajes realizados
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
                                                            <mensajes></mensajes>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- menu rapido -->
                                <!-- <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"  data-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                                        <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
                                        <span class="m-nav__link-icon">
                                            <span class="m-nav__link-icon-wrapper">
                                                <i class="flaticon-share"></i>
                                            </span>
                                        </span>
                                    </a>
                                    @include('layouts.quick')
                                </li> -->
                                <!-- menu rapido -->

                                <!-- sidebar -->
                                <li id="m_quick_sidebar_toggle" class="m-nav__item">
									<a href="#" class="m-nav__link m-dropdown__toggle">
										<span class="m-nav__link-icon m-nav__link-icon--aside-toggle">
											<span class="m-nav__link-icon-wrapper">
												<i class="flaticon-grid-menu"></i>
											</span>
										</span>
									</a>
								</li>
                                <!-- sidebar -->

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
