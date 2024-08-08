<header class="header-section d-none d-xl-block">
    <div class="header-wrapper">
        <div class="header-bottom section-fluid sticky-header" style="background-color: #2a2a92">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <!-- Start Header Logo -->
                        <div class="header-logo">
                            <div class="logo">
                                <a href="{{ route('home') }}"><img class="w-100" src="{{ $systemLogo ? asset('admin/logo/' . $systemLogo) : asset('dist/images/logo.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <!-- End Header Logo -->
                        <style>
                            .mega-menu-sub {
                                width: 477px;
                                max-height: 300px; /* Adjust the height as needed */
                                overflow-y: auto;
                                overflow-x: hidden;
                                box-sizing: border-box;
                            }
                        </style>
                        <!-- Start Header Main Menu -->
                        <div class="main-menu menu-color--white menu-hover-color--pink">
                            <nav>
                                <ul>
                                    <li class="has-dropdown">
                                        <a class="active main-menu-link" href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="has-dropdown has-megaitem">
                                        <a href="product-details-default.html">Shop <i
                                                class="fa fa-angle-down"></i></a>
                                        <!-- Mega Menu -->
                                        <div class="mega-menu">
                                            <ul class="mega-menu-inner">
                                                <!-- Mega Menu Sub Link -->
                                                <li class="mega-menu-item">
                                                    <a href="#" class="mega-menu-item-title">Categories</a>
                                                    <ul class="mega-menu-sub">
                                                        @foreach($categories as $category)
                                                            <li><a href="{{ route('category.products', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                                                        @endforeach
                                                            <li><a href="{{ route('allProducts') }}">All Products</a></li>
                                                    </ul>
                                                </li>

                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="about-us.html">About Us</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contactUs') }}">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- End Header Main Menu Start -->

                        <!-- Start Header Action Link -->
                        <ul class="header-action-link action-color--white action-hover-color--pink">
                            <li>
                                <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                    <i class="icon-bag"></i>
                                    <span class="item-count cart-count" >{{ optional($cartItems)->count()?? 0 }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-profile" class="offacnvas offside-about offcanvas-toggle" style="margin-left: 5px">
                                    <i class="icon-people"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-about" class="offacnvas offside-about offcanvas-toggle">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- End Header Action Link -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
