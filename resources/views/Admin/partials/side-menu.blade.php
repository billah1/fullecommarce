<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4 mt-3">
        <img class="w-28" src="{{ $systemLogo ? asset('admin/logo/' . $systemLogo) : asset('dist/images/logo.svg') }}">
        {{--        <span class="hidden xl:block text-white text-lg ml-3"> Tinker </span>--}}
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="side-menu {{ Request::is('admin/dashboard') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="home"></i></div>
                <div class="side-menu__title">
                    Dashboard
                    <div class="side-menu__sub-icon transform rotate-180"></div>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.setting.logo') }}"
               class="side-menu {{ Request::is('admin/settings/logo') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="home"></i></div>
                <div class="side-menu__title">
                    Logo
                    <div class="side-menu__sub-icon transform rotate-180"></div>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.showAllCategory') }}" class="side-menu {{ Request::is('admin/category') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="inbox"></i></div>
                <div class="side-menu__title"> Categories</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="side-menu {{ Request::is('admin/product/add-new-product') || Request::is('admin/product/list') ? 'side-menu--open' : '' }}">
                <div class="side-menu__icon"><i data-feather="trello"></i></div>
                <div class="side-menu__title">
                    Products
                    <div class="side-menu__sub-icon "><i data-feather="chevron-down"></i></div>
                </div>
            </a>
            <ul class="{{ Request::is('admin/product/add-new-product') || Request::is('admin/product/list') ? 'side-menu__sub-open' : '' }}">
                <li>
                    <a href="{{ route('admin.addNewProduct') }}" class="side-menu {{ Request::is('admin/product/add-new-product') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"><i data-feather="activity"></i></div>
                        <div class="side-menu__title"> Add New Product</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.productList') }}" class="side-menu {{ Request::is('admin/product/list') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"><i data-feather="activity"></i></div>
                        <div class="side-menu__title"> List</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.orderList') }}" class="side-menu {{ Request::is('admin/orders') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="inbox"></i></div>
                <div class="side-menu__title"> Orders</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.sliders') }}" class="side-menu {{ Request::is('admin/sliders') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="inbox"></i></div>
                <div class="side-menu__title"> Slider Manage</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.banner') }}" class="side-menu {{ Request::is('admin/banners') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="inbox"></i></div>
                <div class="side-menu__title"> Banner Manage</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.coupons') }}" class="side-menu {{ Request::is('admin/Coupons') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="inbox"></i></div>
                <div class="side-menu__title"> Coupon Manage</div>
            </a>
        </li>
    </ul>
</nav>
