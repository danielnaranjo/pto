<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
    <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
        <a  href="/home" class="m-menu__link ">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">
                Home
            </span>
        </a>
    </li>
    <li class="m-menu__item" >
        <a  href="/package" class="m-menu__link">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">
                Paqueto Envios
            </span>
        </a>
    </li>
    <li class="m-menu__item ">
        <a  href="/travel" class="m-menu__link">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">
                Paqueto Viajeros
            </span>
        </a>
    </li>
    <!-- <li class="m-menu__item m-menu__item--submenu m-menu__item--rel m-menu__item--open-dropdown m-menu__item--hover" data-menu-submenu-toggle="click" aria-haspopup="true">
		<a href="javascript:;" class="m-menu__link m-menu__toggle">
			<span class="m-menu__item-here"></span>
			<span class="m-menu__link-text">
				Mi Actividad
			</span>
			<i class="m-menu__hor-arrow la la-angle-down"></i>
			<i class="m-menu__ver-arrow la la-angle-right"></i>
		</a>
		<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
			<span class="m-menu__arrow m-menu__arrow--adjust" style="left: 58px;color:#368ee0"></span>
			<ul class="m-menu__subnav">
				<li class="m-menu__item " aria-haspopup="true">
					<a href="/" class="m-menu__link ">
						<span class="m-menu__link-title">
    						Conversaciones
						</span>
					</a>
				</li>
                <li class="m-menu__item " aria-haspopup="true">
					<a href="/" class="m-menu__link ">
						<span class="m-menu__link-title">
    						Pagos recibidos
						</span>
					</a>
				</li>
                <li class="m-menu__item " aria-haspopup="true">
					<a href="/" class="m-menu__link ">
						<span class="m-menu__link-title">
    						Paquetes enviados
						</span>
					</a>
				</li>
                <li class="m-menu__item " aria-haspopup="true">
					<a href="/" class="m-menu__link ">
						<span class="m-menu__link-title">
    						Viajes realizados
						</span>
					</a>
				</li>
			</ul>
		</div>
	</li> -->
    <!-- <li class="m-menu__item ">
        <a  href="/user" class="m-menu__link m-menu__toggle">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">
                Mi Perfil
            </span>
        </a>
    </li> -->
    <li class="m-menu__item">
        <a  href="{{ route('logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();" class="m-menu__link">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">
                Cerrar sesión
            </span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>
