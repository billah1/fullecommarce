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
                        <h3 class="breadcrumb-title">Shop - Full Width</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                    <li class="active" aria-current="page">Shop Full Width</li>
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
                                    <!-- Start Sort tab Button -->

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
                                                                        src="{{ asset('admin/product/'. $item->productImage->first()->image) }}"
                                                                        alt="">
                                                                    <img
                                                                        src="{{ asset('admin/product/'. optional($item->productImage->skip(1)->first())->image) }}"
                                                                        alt="">
                                                                </a>
                                                                <div class="action-link">
                                                                    <div class="action-link-left">
                                                                        <a href="#" data-bs-toggle="modal"
                                                                           class="add-to-cart-btn"
                                                                           data-product-id="{{ $item->id }}"
                                                                           data-product-price="{{ isset($item->discount_price) ? $item->discount_price :$item->price }}"
                                                                           data-bs-target="#modalAddcart-{{ $item->id }}">Add
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
                                                                            href="{{ route('product.details', ['product' => $item->id]) }}">{{ $item->name }}</a>
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
                                                                    @if(isset($item->discount_price))
                                                                        <span class="price" style="text-decoration: line-through">{{ $item->symbol->symbol }}{{ $item->price }}</span>
                                                                        <span class="price">{{ $item->symbol->symbol }}{{ $item->discount_price }}</span>
                                                                    @else
                                                                        <span class="price">{{ $item->symbol->symbol }}{{ $item->price }}</span>
                                                                    @endif
{{--                                                                    <span class="price">{{ $item->symbol->symbol }}{{ $item->price }}</span>--}}
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
                                                                     src="{{ asset('admin/product/'. $item->productImage->first()->image) }}"
                                                                     alt="">
                                                                <img class="img-fluid"
                                                                     src="{{ asset('admin/product/'. optional($item->productImage->skip(1)->first())->image) }}"
                                                                     alt="">
                                                            </a>
                                                            <div class="product-list-content">
                                                                <h5 class="product-list-link"><a
                                                                        href="{{ route('product.details', ['product' => $item->id]) }}">{{ $item->name }}</a>
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
                                                                <span class="product-list-price"><del>{{ $item->symbol->symbol }} {{ $item->price }}</del></span>
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
                                                                       data-product-id="{{ $item->id }}"
                                                                       data-product-price="{{ isset($item->discount_price) ? $item->discount_price :$item->price }}">Add
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
        <div class="modal fade" id="modalAddcart-{{ $item->id }}" tabindex="-1" role="dialog"
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
                                                         src="{{ asset('admin/product/'. $item->productImage->first()->image) }}"
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
                                                    <a href="{{ route('user.checkout', ['product' => $item->id]) }}">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 modal-border">
                                        <ul class="modal-add-cart-product-shipping-info">
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
