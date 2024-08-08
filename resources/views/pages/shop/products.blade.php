@extends('welcome')
@push('css')
    <style>
        .product-default-single-item .image-box img,
        .product-list-single .product-list-img-link img {
            width: 100%; /* or specific fixed width */
            height: 300px; /* or specific fixed height */
            object-fit: cover;
        }

        .product-list-single .product-list-img-link img {
            width: 250px; /* or a specific fixed width */
            height: 300px; /* or a specific fixed height */
            object-fit: cover;
        }

    </style>
@endpush
@section('content')
    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Shop</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Shop Section:::... -->
    <div class="shop-section">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-12">
                    <!-- Start Shop Product Sorting Section -->
                    <div class="shop-sort-section">
                        <div class="container">
                            <div class="row">
                                <!-- Start Sort Wrapper Box -->
                                <div
                                    class="sort-box d-flex justify-content-end align-items-md-center align-items-start flex-md-row flex-column"
                                    data-aos="fade-up" data-aos-delay="0">

                                    <!-- Start Sort Select Option -->
                                    <div class="sort-select-list d-flex align-items-center">
                                        <label class="mr-2">Sort By:</label>
                                        <form action="#">
                                            <fieldset>
                                                <select name="speed" id="speed">
                                                    <option>Sort by average rating</option>
                                                    <option>Sort by popularity</option>
                                                    <option selected="selected">Sort by newness</option>
                                                    <option>Sort by price: low to high</option>
                                                    <option>Sort by price: high to low</option>
                                                    <option>Product Name: Z</option>
                                                </select>
                                            </fieldset>
                                        </form>
                                    </div> <!-- End Sort Select Option -->


                                </div> <!-- Start Sort Wrapper Box -->
                            </div>
                        </div>
                    </div> <!-- End Section Content -->

                    <!-- Start Tab Wrapper -->
                    <div class="sort-product-tab-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content">
                                        <!-- Start Grid View Product -->
                                        <div class="tab-pane active show sort-layout-single" id="layout-4-grid">
                                            <div class="row">
                                                @foreach($items as $item)
                                                    <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                                        <!-- Start Product Default Single Item -->
                                                        <div class="product-default-single-item product-color--pink"
                                                             data-aos="fade-up" data-aos-delay="0">
                                                            <div class="image-box">
                                                                <a href="product-details-default.html"
                                                                   class="image-link">
                                                                    <img
                                                                        src="{{ asset('admin/product/'. $item->product->productImage->first()->image) }}"
                                                                        alt="">
                                                                    <img
                                                                        src="{{ asset('admin/product/'. optional($item->product->productImage->skip(1)->first())->image) }}"
                                                                        alt="">
                                                                </a>
                                                                <div class="action-link">
                                                                    <div class="action-link-left">
                                                                        <a href="#" data-bs-toggle="modal"
                                                                           class="add-to-cart-btn"
                                                                           data-product-id="{{ $item->product->id }}"
                                                                           data-product-price="{{ isset($item->product->discount_price) ? $item->product->discount_price :$item->product->price }}"
                                                                           data-bs-target="#modalAddcart-{{ $item->product->id }}">Add
                                                                            to
                                                                            Cart</a>
                                                                    </div>
                                                                    <div class="action-link-right">
                                                                        <a href="#" data-bs-toggle="modal"
                                                                           data-bs-target="#modalQuickview"><i
                                                                                class="icon-magnifier"></i></a>
                                                                        <a href="wishlist.html"><i
                                                                                class="icon-heart"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="content-left">
                                                                    <h6 class="title"><a
                                                                            href="{{ route('product.details', ['product' => $item->product->id]) }}">{{ $item->product->name }}</a>
                                                                    </h6>
                                                                    <ul class="review-star">
                                                                        <li class="fill"><i
                                                                                class="ion-android-star"></i>
                                                                        </li>
                                                                        <li class="fill"><i
                                                                                class="ion-android-star"></i>
                                                                        </li>
                                                                        <li class="fill"><i
                                                                                class="ion-android-star"></i>
                                                                        </li>
                                                                        <li class="fill"><i
                                                                                class="ion-android-star"></i>
                                                                        </li>
                                                                        <li class="empty"><i
                                                                                class="ion-android-star"></i>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="content-right">
                                                                    @if(isset($item->product->discount_price))
                                                                        <del class="price">{{ $item->product->symbol->symbol }}{{ $item->product->price }}</del>
                                                                        <span class="price">{{ $item->product->symbol->symbol }}{{ $item->product->discount_price }}</span>
                                                                    @else
                                                                        <span class="price">{{ $item->product->symbol->symbol }}{{ $item->product->price }}</span>
                                                                    @endif
{{--                                                                    <span--}}
{{--                                                                        class="price">{{ $item->product->symbol->symbol }}{{ $item->product->price }}</span>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Product Default Single Item -->
                                                @endforeach

                                            </div>
                                        </div> <!-- End Grid View Product -->
                                        <!-- Start List View Product -->
                                        <div class="tab-pane sort-layout-single" id="layout-list">
                                            <div class="row">
                                                @foreach($items as $item)
                                                    <div class="col-12">
                                                        <!-- Start Product Defautlt Single -->
                                                        <div class="product-list-single product-color--golden">
                                                            <a href="product-details-default.html"
                                                               class="product-list-img-link">
                                                                <img class="img-fluid"
                                                                     src="{{ asset('admin/product/'. $item->product->productImage->first()->image) }}"
                                                                     alt="">
                                                                <img class="img-fluid"
                                                                     src="{{ asset('admin/product/'. optional($item->product->productImage->skip(1)->first())->image) }}"
                                                                     alt="">
                                                            </a>
                                                            <div class="product-list-content">
                                                                <h5 class="product-list-link"><a
                                                                        href="{{ route('product.details', ['product' => $item->id]) }}">{{ $item->product->name }}</a>
                                                                </h5>
                                                                <ul class="review-star">
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="empty"><i class="ion-android-star"></i>
                                                                    </li>
                                                                </ul>
                                                                <span class="product-list-price"><del>{{ $item->product->symbol->symbol }} {{ $item->product->price }}</del></span>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                    elit.
                                                                    Nobis ad, iure incidunt. Ab consequatur temporibus
                                                                    non
                                                                    eveniet inventore doloremque necessitatibus sed,
                                                                    ducimus
                                                                    quisquam, ad asperiores</p>
                                                                <div class="product-action-icon-link-list">
                                                                    <a href="#"
                                                                       class="btn btn-lg btn-black-default-hover add-to-cart-btn"
                                                                       data-product-id="{{ $item->product->id }}"
                                                                       data-product-price="{{ isset($item->product->discount_price) ? $item->product->discount_price :$item->product->price }}">Add
                                                                        to
                                                                        cart</a>
                                                                    <a href="#" data-bs-toggle="modal"
                                                                       data-bs-target="#modalQuickview"
                                                                       class="btn btn-lg btn-black-default-hover"><i
                                                                            class="icon-magnifier"></i></a>
                                                                    <a href="wishlist.html"
                                                                       class="btn btn-lg btn-black-default-hover"><i
                                                                            class="icon-heart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div> <!-- End Product Defautlt Single -->
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div> <!-- End List View Product -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Tab Wrapper -->

                    <!-- Start Pagination -->
                    {{ $items->links('vendor.pagination.custom-pagination') }}
                    <!-- End Pagination -->
                </div> <!-- End Shop Product Sorting Section  -->
            </div>
        </div>
    </div> <!-- ...:::: End Shop Section:::... -->


    <!-- Start Modal Add cart -->
    @foreach($items as $item)
        <div class="modal fade" id="modalAddcart-{{ $item->product->id }}" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col text-right">
                                    <button type="button" class="close modal-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                    </button>
                                </div>
                            </div>
                            @if(auth()->check())
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="modal-add-cart-product-img">
                                                    <img class="img-fluid"
                                                         src="{{ asset('admin/product/'. $item->product->productImage->first()->image) }}"
                                                         alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="modal-add-cart-info"><i class="fa fa-check-square"></i>Added
                                                    to cart
                                                    successfully!
                                                </div>
                                                <div class="modal-add-cart-product-cart-buttons">
                                                    <a href="cart.html">View Cart</a>
                                                    <a href="{{ route('user.checkout', ['product' => $item->product->id]) }}">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 modal-border">
                                        <ul class="modal-add-cart-product-shipping-info">
                                            <li><strong>TOTAL PRICE: </strong> <span>$187.00</span></li>
                                            <li class="modal-continue-button"><a href="#" data-bs-dismiss="modal">CONTINUE
                                                    SHOPPING</a></li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <h1>You Must need to login First to cart a Product</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Modal Add cart -->
    @endforeach

    <!-- Start Modal Quickview cart -->
    {{--    <div class="modal fade" id="modalQuickview" tabindex="-1" role="dialog" aria-hidden="true">--}}
    {{--        <div class="modal-dialog  modal-dialog-centered" role="document">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-body">--}}
    {{--                    <div class="container-fluid">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col text-right">--}}
    {{--                                <button type="button" class="close modal-close" data-bs-dismiss="modal"--}}
    {{--                                        aria-label="Close">--}}
    {{--                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>--}}
    {{--                                </button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col-md-6">--}}
    {{--                                <div class="product-details-gallery-area mb-7">--}}
    {{--                                    <!-- Start Large Image -->--}}
    {{--                                    <div class="product-large-image modal-product-image-large swiper-container">--}}
    {{--                                        <div class="swiper-wrapper">--}}
    {{--                                            <div class="product-image-large-image swiper-slide img-responsive">--}}
    {{--                                                <img src="assets/images/product/default/home-1/default-1.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="product-image-large-image swiper-slide img-responsive">--}}
    {{--                                                <img src="assets/images/product/default/home-1/default-2.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="product-image-large-image swiper-slide img-responsive">--}}
    {{--                                                <img src="assets/images/product/default/home-1/default-3.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="product-image-large-image swiper-slide img-responsive">--}}
    {{--                                                <img src="assets/images/product/default/home-1/default-4.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="product-image-large-image swiper-slide img-responsive">--}}
    {{--                                                <img src="assets/images/product/default/home-1/default-5.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="product-image-large-image swiper-slide img-responsive">--}}
    {{--                                                <img src="assets/images/product/default/home-1/default-6.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                    <!-- End Large Image -->--}}
    {{--                                    <!-- Start Thumbnail Image -->--}}
    {{--                                    <div--}}
    {{--                                        class="product-image-thumb modal-product-image-thumb swiper-container pos-relative mt-5">--}}
    {{--                                        <div class="swiper-wrapper">--}}
    {{--                                            <div class="product-image-thumb-single swiper-slide">--}}
    {{--                                                <img class="img-fluid"--}}
    {{--                                                     src="assets/images/product/default/home-1/default-1.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="product-image-thumb-single swiper-slide">--}}
    {{--                                                <img class="img-fluid"--}}
    {{--                                                     src="assets/images/product/default/home-1/default-2.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="product-image-thumb-single swiper-slide">--}}
    {{--                                                <img class="img-fluid"--}}
    {{--                                                     src="assets/images/product/default/home-1/default-3.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="product-image-thumb-single swiper-slide">--}}
    {{--                                                <img class="img-fluid"--}}
    {{--                                                     src="assets/images/product/default/home-1/default-4.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="product-image-thumb-single swiper-slide">--}}
    {{--                                                <img class="img-fluid"--}}
    {{--                                                     src="assets/images/product/default/home-1/default-5.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="product-image-thumb-single swiper-slide">--}}
    {{--                                                <img class="img-fluid"--}}
    {{--                                                     src="assets/images/product/default/home-1/default-6.jpg" alt="">--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <!-- Add Arrows -->--}}
    {{--                                        <div class="gallery-thumb-arrow swiper-button-next"></div>--}}
    {{--                                        <div class="gallery-thumb-arrow swiper-button-prev"></div>--}}
    {{--                                    </div>--}}
    {{--                                    <!-- End Thumbnail Image -->--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <div class="col-md-6">--}}
    {{--                                <div class="modal-product-details-content-area">--}}
    {{--                                    <!-- Start  Product Details Text Area-->--}}
    {{--                                    <div class="product-details-text">--}}
    {{--                                        <h4 class="title">Nonstick Dishwasher PFOA</h4>--}}
    {{--                                        <div class="price"><del>$70.00</del>$80.00</div>--}}
    {{--                                    </div> <!-- End  Product Details Text Area-->--}}
    {{--                                    <!-- Start Product Variable Area -->--}}
    {{--                                    <div class="product-details-variable">--}}
    {{--                                        <!-- Product Variable Single Item -->--}}
    {{--                                        <div class="variable-single-item">--}}
    {{--                                            <span>Color</span>--}}
    {{--                                            <div class="product-variable-color">--}}
    {{--                                                <label for="modal-product-color-red">--}}
    {{--                                                    <input name="modal-product-color" id="modal-product-color-red"--}}
    {{--                                                           class="color-select" type="radio" checked>--}}
    {{--                                                    <span class="product-color-red"></span>--}}
    {{--                                                </label>--}}
    {{--                                                <label for="modal-product-color-tomato">--}}
    {{--                                                    <input name="modal-product-color" id="modal-product-color-tomato"--}}
    {{--                                                           class="color-select" type="radio">--}}
    {{--                                                    <span class="product-color-tomato"></span>--}}
    {{--                                                </label>--}}
    {{--                                                <label for="modal-product-color-green">--}}
    {{--                                                    <input name="modal-product-color" id="modal-product-color-green"--}}
    {{--                                                           class="color-select" type="radio">--}}
    {{--                                                    <span class="product-color-green"></span>--}}
    {{--                                                </label>--}}
    {{--                                                <label for="modal-product-color-light-green">--}}
    {{--                                                    <input name="modal-product-color"--}}
    {{--                                                           id="modal-product-color-light-green" class="color-select"--}}
    {{--                                                           type="radio">--}}
    {{--                                                    <span class="product-color-light-green"></span>--}}
    {{--                                                </label>--}}
    {{--                                                <label for="modal-product-color-blue">--}}
    {{--                                                    <input name="modal-product-color" id="modal-product-color-blue"--}}
    {{--                                                           class="color-select" type="radio">--}}
    {{--                                                    <span class="product-color-blue"></span>--}}
    {{--                                                </label>--}}
    {{--                                                <label for="modal-product-color-light-blue">--}}
    {{--                                                    <input name="modal-product-color"--}}
    {{--                                                           id="modal-product-color-light-blue" class="color-select"--}}
    {{--                                                           type="radio">--}}
    {{--                                                    <span class="product-color-light-blue"></span>--}}
    {{--                                                </label>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <!-- Product Variable Single Item -->--}}
    {{--                                        <div class="d-flex align-items-center flex-wrap">--}}
    {{--                                            <div class="variable-single-item ">--}}
    {{--                                                <span>Quantity</span>--}}
    {{--                                                <div class="product-variable-quantity">--}}
    {{--                                                    <input min="1" max="100" value="1" type="number">--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}

    {{--                                            <div class="product-add-to-cart-btn">--}}
    {{--                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add To--}}
    {{--                                                    Cart</a>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div> <!-- End Product Variable Area -->--}}
    {{--                                    <div class="modal-product-about-text">--}}
    {{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste--}}
    {{--                                            laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam--}}
    {{--                                            in quos qui nemo ipsum numquam, reiciendis maiores quidem aperiam, rerum vel--}}
    {{--                                            recusandae</p>--}}
    {{--                                    </div>--}}
    {{--                                    <!-- Start  Product Details Social Area-->--}}
    {{--                                    <div class="modal-product-details-social">--}}
    {{--                                        <span class="title">SHARE THIS PRODUCT</span>--}}
    {{--                                        <ul>--}}
    {{--                                            <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>--}}
    {{--                                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>--}}
    {{--                                            <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>--}}
    {{--                                            <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>--}}
    {{--                                            </li>--}}
    {{--                                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>--}}
    {{--                                        </ul>--}}

    {{--                                    </div> <!-- End  Product Details Social Area-->--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div> --}}
    <!-- End Modal Quickview cart -->
    <!-- Start Modal Add cart -->
    <div class="modal fade" id="modalAddcart" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    @if(auth()->check())
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col text-right">
                                    <button type="button" class="close modal-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="modal-add-cart-product-img">
                                                <img class="img-fluid"
                                                     src="{{ asset('assets/images/product/default/home-1/default-1.jpg') }}"
                                                     alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="modal-add-cart-info"><i class="fa fa-check-square"></i>Added to
                                                cart
                                                successfully!
                                            </div>
                                            <div class="modal-add-cart-product-cart-buttons">
                                                <a href="cart.html">View Cart</a>
                                                <a href="checkout.html">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 modal-border">
                                    <ul class="modal-add-cart-product-shipping-info">
                                        <li><strong><i class="icon-shopping-cart"></i> There Are 5 Items In Your
                                                Cart.</strong></li>
                                        <li><strong>TOTAL PRICE: </strong> <span>$187.00</span></li>
                                        <li class="modal-continue-button"><a href="#" data-bs-dismiss="modal">CONTINUE
                                                SHOPPING</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @else
                        <h1>You Must need to login First to cart a Product</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Add cart -->

@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var basePath = "{{ asset('admin/product/') }}";
        var subTotal = 0;
        var count = 0;

        $(document).ready(function () {
            $('.add-to-cart-btn').click(function (e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                var productPrice = $(this).data('product-price');
                var quantity = 1;
                updateCart('/add-to-cart', {product_id: productId, quantity: quantity, price: productPrice});
            });

            $('.offcanvas-cart').on('click', '.cart-delete', function (e) {
                e.preventDefault();
                var cartId = $(this).data('cart-id');
                updateCart('/delete-cart', {cart_id: cartId});
            });
        });

        function updateCart(url, data) {
            $.ajax({
                url: url,
                type: 'POST',
                data: Object.assign({_token: '{{ csrf_token() }}'}, data),
                success: function (response) {
                    renderCart(response.data);
                },
                error: function (error) {
                    console.error('Cart update error:', error);
                }
            });
        }

        function renderCart(items) {
            $('.offcanvas-cart').empty();
            subTotal = 0;
            count = 0;

            items.forEach(function (item) {
                subTotal += parseFloat(item.total_price);
                count += 1;
                $('.offcanvas-cart').append(cartItemHtml(item));
            });

            $('.offcanvas-cart-total-price-value').text('৳ ' + subTotal);
            $('.cart-count').text(count);
        }

        function cartItemHtml(item) {
            return `
            <li class="offcanvas-cart-item-single">
                <div class="offcanvas-cart-item-block">
                    <a href="#" class="offcanvas-cart-item-image-link">
                        <img src="${basePath + '/' + item.product.product_image[0].image}" alt="" class="offcanvas-cart-image">
                    </a>
                    <div class="offcanvas-cart-item-content">
                        <a href="#" class="offcanvas-cart-item-link">${item.product.name}</a>
                        <div class="offcanvas-cart-item-details">
                            <span class="offcanvas-cart-item-details-quantity">${item.quantity} x </span>
                            <span class="offcanvas-cart-item-details-price">$${item.price}</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-cart-item-delete text-right">
                    <a href="#" class="offcanvas-cart-item-delete cart-delete" data-cart-id="${item.id}"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
        `;
        }
    </script>

@endpush
