<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{ $systemLogo ? asset('admin/logo/' . $systemLogo) : asset('dist/images/logo.svg') }}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-white/[0.08] py-5 hidden">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="menu {{ Request::is('admin/dashboard') ? ' menu--active' : '' }}">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Dashboard  </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="menu {{ Request::is('admin/dashboard') ? ' menu--active' : '' }}">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Logo </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.showAllCategory') }}" class="menu {{ Request::is('admin/dashboard') ? ' menu--active' : '' }}">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Categories </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="menu">
                <div class="menu__icon"> <i data-feather="box"></i> </div>
                <div class="menu__title"> Products <i data-feather="chevron-down" class="menu__sub-icon "></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ route('admin.addNewProduct') }}" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Add New Product </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.productList') }}" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> List </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.orderList') }}" class="menu">
                <div class="menu__icon"> <i data-feather="inbox"></i> </div>
                <div class="menu__title"> Orders </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.sliders') }}" class="menu">
                <div class="menu__icon"> <i data-feather="hard-drive"></i> </div>
                <div class="menu__title"> Slider Manage </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.banner') }}" class="menu">
                <div class="menu__icon"> <i data-feather="credit-card"></i> </div>
                <div class="menu__title"> Banner Manage </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.coupons') }}" class="menu">
                <div class="menu__icon"> <i data-feather="message-square"></i> </div>
                <div class="menu__title"> Coupon Manage </div>
            </a>
        </li>
    </ul>
</div>
