<!DOCTYPE html>
<html lang="zxx">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>পাঞ্জাবিওয়ালা</title>

    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="shortcut icon" href="{{ $systemLogo ? asset('admin/logo/' . $systemLogo) : asset('dist/images/logo.svg') }}" type="image/png">

    @include('inc.style')

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css"> -->

</head>

<body>
<!-- Start Header Area -->
@include('partials.header')
<!-- Start Header Area -->

<!-- Start Mobile Header -->
@include('partials.mobile-header')
<!-- End Mobile Header -->

<!--  Start Offcanvas Mobile Menu Section -->
@include('partials.mobile-menu')
<!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

<!-- Start Offcanvas side Menu Section -->
@include('partials.side-menu')
<!-- ...:::: End Offcanvas side Menu Section:::... -->

<!-- Start Offcanvas Addcart Section -->
@include('partials.add-cart')
<!-- End  Offcanvas Addcart Section -->

<!-- Start Offcanvas wishlish Menu Section -->
@include('partials.wish-list')
<!-- End Offcanvas wishlish Menu Section -->

<!-- Start Offcanvas Search Bar Section -->
@include('partials.search-bar')
<!-- End Offcanvas Search Bar Section -->

<!-- Offcanvas Overlay -->
{{--<div class="offcanvas-overlay"></div>--}}

@yield('content')



<!-- Start Footer Section -->
@include('partials.footer')
<!-- End Footer Section -->


@include('inc.script')
</body>



</html>
