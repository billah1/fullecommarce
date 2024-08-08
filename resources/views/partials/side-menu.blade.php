<div id="offcanvas-about" class="offcanvas offcanvas-rightside offcanvas-mobile-about-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->
    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <!-- Start Mobile contact Info -->
    <div class="mobile-contact-info">
        <div class="logo">
            <a href="{{ route('home') }}"><img
                    src="{{ $systemLogo ? asset('admin/logo/' . $systemLogo) : asset('dist/images/logo.svg') }}" alt=""></a>
        </div>

        <address class="address">
            <span>Address: Moti Plaza (2nd Floor) Ship Company Junction, Rangpur.</span>
            <span>Call Us: +8801331551351</span>
            <span>Email: panjabiwala.rng@gmail.com</span>
        </address>
    </div>
    <!-- End Mobile contact Info -->
</div>

<div id="offcanvas-profile" class="offcanvas offcanvas-rightside offcanvas-mobile-about-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->
    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <!-- Start Mobile contact Info -->
    <div class="mobile-contact-info">
        <div class="logo">
            <a href="{{ route('home') }}"><img
                    src="{{ $systemLogo ? asset('admin/logo/' . $systemLogo) : asset('dist/images/logo.svg') }}" alt=""></a>
        </div>

        <address class="address">
            @if(!auth()->check())
                <span>You Are not Logged in</span>
            @else
                <span>{{ auth()->user()->name }}</span>
                {{--            <span>Call Us: 0123456789, 0123456789</span>--}}
                <span>Email: {{ auth()->user()->email }}</span>
            @endif
        </address>

        <ul class="d-flex justify-content-center align-items-center">
            @if(!auth()->check())
                <li><a href="{{ route('user.auth') }}" class="btn btn-black-default-hover">Login</a></li>
                <li><a href="{{ route('user.auth') }}" class="btn btn-black-default-hover">Register</a></li>
            @else
                <li><a href="{{ route('user.account') }}" class="btn btn-black-default-hover">Account</a></li>
                <form action="{{ route('user.auth.logout') }}" method="post">
                    @csrf
                    <li>
                        <button type="submit" class="btn btn-black-default-hover">Logout</button>
                    </li>
                </form>
            @endif
        </ul>
    </div>
    <!-- End Mobile contact Info -->
</div>
