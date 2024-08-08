<div id="mobile-menu-offcanvas" class="offcanvas offcanvas-rightside offcanvas-mobile-menu-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->
    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <div class="offcanvas-mobile-menu-wrapper">
        <!-- Start Mobile Menu  -->
        <div class="mobile-menu-bottom">
            <!-- Start Mobile Menu Nav -->
            <div class="offcanvas-menu">
                <ul>
                    <li>
                        <a href="{{ route('home') }}"><span>Home</span></a>
                    </li>
                    <li>
                        <a href="#"><span>Shop</span></a>
                        <ul class="mobile-sub-menu">
                            <li>
                                <a href="#">Categories</a>
                                <ul class="mobile-sub-menu">
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{ route('category.products', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ route('allProducts') }}">All Products</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><span>My Account</span></a>
                        <ul class="mobile-sub-menu">
                            @if(auth()->check())
                                <li>
                                    <a href="{{ route('user.account') }}">Dashboard</a>
                                </li>
                                <form id="logoutForm" action="{{ route('user.auth.logout') }}" method="POST">
                                    @csrf
                                </form>
                                <li>
                                    <a href="javascript:void(0);" onclick="document.getElementById('logoutForm').submit();">Log out</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('user.auth') }}">Login</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li><a href="about-us.html">About Us</a></li>
                    <li><a href="{{ route('contactUs') }}">Contact Us</a></li>
                </ul>
            </div> <!-- End Mobile Menu Nav -->
        </div> <!-- End Mobile Menu -->

    </div> <!-- End Offcanvas Mobile Menu Wrapper -->
</div>
