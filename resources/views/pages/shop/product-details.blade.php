@extends('welcome')
@push('css')

@endpush
@section('content')
    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Product Details</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                    <li class="active" aria-current="page">Product Details</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- Start Product Details Section -->
    <div class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div
                        class="product-details-gallery-area product-details-gallery-area-vartical product-details-gallery-area-vartical-right"
                        data-aos="fade-up" data-aos-delay="0">
                        <!-- Start Large Image -->
                        <div class="product-large-image product-large-image-vartical swiper-container mr-5">
                            <div class="swiper-wrapper">
                                @foreach($item->productImage as $image)
                                    <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                        <img src="{{ asset('admin/product/'. $image->image) }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Large Image -->
                        <!-- Start Thumbnail Image -->
                        <div class="product-image-thumb product-image-thumb-vartical swiper-container pos-relative">
                            <div class="swiper-wrapper">
                                @foreach($item->productImage as $image)
                                    <div class="product-image-thumb-single swiper-slide">
                                        <img class="img-fluid" src="{{ asset('admin/product/'. $image->image) }}"
                                             alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Thumbnail Image -->
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="product-details-content-area product-details--golden" data-aos="fade-up"
                         data-aos-delay="200">
                        <!-- Start  Product Details Text Area-->
                        <div class="product-details-text">
                            <h4 class="title">{{ $item->name }}</h4>
                            <div class="d-flex align-items-center">
                                <ul class="review-star">
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="empty"><i class="ion-android-star"></i></li>
                                </ul>
                                <a href="#" class="customer-review ml-2">(customer review )</a>
                            </div>
                            @if(isset($item->discount_price))
                                <del class="price">{{ $item->symbol->symbol }} {{ $item->price }}</del>
                                <div class="price">{{ $item->symbol->symbol }} {{ $item->discount_price }}</div>
                            @else
                                <div class="price">{{ $item->symbol->symbol }} {{ $item->price }}</div>
                            @endif
                            <p>{{ $item->description }}</p>
                        </div>
                        <!-- End  Product Details Text Area-->
                        <!-- Start Product Variable Area -->
                        <div class="product-details-variable">
                            <h4 class="title">Available Options</h4>
                            <!-- Product Variable Single Item -->
                            <div class="variable-single-item">
                                <div class="product-stock"> <span class="product-stock-in"><i
                                            class="ion-checkmark-circled"></i></span> {{ $item->stock }} IN STOCK
                                </div>
                            </div>
                            <!-- Product Variable Single Item -->
{{--                            <div class="variable-single-item">--}}
{{--                                <span>Color</span>--}}
{{--                                <div class="product-variable-color">--}}
{{--                                    <label for="product-color-red">--}}
{{--                                        <input name="product-color" id="product-color-red" class="color-select"--}}
{{--                                               type="radio" checked>--}}
{{--                                        <span class="product-color-red"></span>--}}
{{--                                    </label>--}}
{{--                                    <label for="product-color-tomato">--}}
{{--                                        <input name="product-color" id="product-color-tomato" class="color-select"--}}
{{--                                               type="radio">--}}
{{--                                        <span class="product-color-tomato"></span>--}}
{{--                                    </label>--}}
{{--                                    <label for="product-color-green">--}}
{{--                                        <input name="product-color" id="product-color-green" class="color-select"--}}
{{--                                               type="radio">--}}
{{--                                        <span class="product-color-green"></span>--}}
{{--                                    </label>--}}
{{--                                    <label for="product-color-light-green">--}}
{{--                                        <input name="product-color" id="product-color-light-green" class="color-select"--}}
{{--                                               type="radio">--}}
{{--                                        <span class="product-color-light-green"></span>--}}
{{--                                    </label>--}}
{{--                                    <label for="product-color-blue">--}}
{{--                                        <input name="product-color" id="product-color-blue" class="color-select"--}}
{{--                                               type="radio">--}}
{{--                                        <span class="product-color-blue"></span>--}}
{{--                                    </label>--}}
{{--                                    <label for="product-color-light-blue">--}}
{{--                                        <input name="product-color" id="product-color-light-blue" class="color-select"--}}
{{--                                               type="radio">--}}
{{--                                        <span class="product-color-light-blue"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!-- Product Variable Single Item -->
                            <div class="d-flex align-items-center ">
                                <div class="variable-single-item ">
                                    <span>Quantity</span>
                                    <div class="product-variable-quantity">
                                        <input min="1" max="{{ $item->stock }}" value="1" type="number" id="quantity">
                                    </div>
                                </div>

                                @if($item->stock > 0)
                                    <div class="product-add-to-cart-btn">
                                        <a href="#" class="add-to-cart-btn" data-product-id="{{ $item->id }}"
                                           data-product-price="{{ isset($item->discount_price) ? $item->discount_price :$item->price }}" data-bs-toggle="modal"
                                           data-bs-target="#modalAddcart-{{ $item->id }}">+ Add To Cart</a>
                                    </div>
                                @else
                                    <div class="product-add-to-cart-btn">
                                        <button class="out-of-stock-btn" disabled>Out Of Stock</button>
                                    </div>
                                @endif
                            </div>
                            <!-- Start  Product Details Meta Area-->

                            <!-- End  Product Details Meta Area-->
                        </div>
                        <!-- End Product Variable Area -->

                        <!-- Start  Product Details Catagories Area-->
                        <div class="product-details-catagory mb-2">
                            <span class="title">CATEGORIES:</span>
                            {{--                            TODO: Need to fix comma issue--}}
                            <ul>
                                @foreach ($item->productCategory as $category)
                                    <li>
                                        <a href="{{ route('category.products', ['category' => $category->category->id]) }}">{{ $category->category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End  Product Details Catagories Area-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Details Section -->
    <!-- Start Product Content Tab Section -->
    <div class="product-details-content-tab-section section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details-content-tab-wrapper" data-aos="fade-up" data-aos-delay="0">

                        <!-- Start Product Details Tab Button -->
                        <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                            <li><a class="nav-link active" data-bs-toggle="tab" href="#description">
                                    Description
                                </a></li>
                        </ul> <!-- End Product Details Tab Button -->

                        <!-- Start Product Details Tab Content -->
                        <div class="product-details-content-tab">
                            <div class="tab-content">
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane active show" id="description">
                                    <div class="single-tab-content-item">
                                        <p>{{ $item->description }}</p>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane" id="specification">
                                    <div class="single-tab-content-item">
                                        <table class="table table-bordered mb-20">
                                            <tbody>
                                            <tr>
                                                <th scope="row">Compositions</th>
                                                <td>Polyester</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Styles</th>
                                                <td>Girly</td>
                                            <tr>
                                                <th scope="row">Properties</th>
                                                <td>Short Dress</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p>Fashion has been creating well-designed collections since 2010. The brand
                                            offers feminine designs delivering stylish separates and statement dresses
                                            which have since evolved into a full ready-to-wear collection in which every
                                            item is a vital part of a woman's wardrobe. The result? Cool, easy, chic
                                            looks with youthful elegance and unmistakable signature style. All the
                                            beautiful pieces are made in Italy and manufactured with the greatest
                                            attention. Now Fashion extends to a range of accessories including shoes,
                                            hats, belts and more!</p>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane" id="review">
                                    <div class="single-tab-content-item">
                                        <!-- Start - Review Comment -->
                                        <ul class="comment">
                                            <!-- Start - Review Comment list-->
                                            <li class="comment-list">
                                                <div class="comment-wrapper">
                                                    <div class="comment-img">
                                                        <img src="assets/images/user/image-1.png" alt="">
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="comment-content-top">
                                                            <div class="comment-content-left">
                                                                <h6 class="comment-name">Kaedyn Fraser</h6>
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
                                                            </div>
                                                            <div class="comment-content-right">
                                                                <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                            </div>
                                                        </div>

                                                        <div class="para-content">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                Tempora inventore dolorem a unde modi iste odio amet,
                                                                fugit fuga aliquam, voluptatem maiores animi dolor nulla
                                                                magnam ea! Dignissimos aspernatur cumque nam quod sint
                                                                provident modi alias culpa, inventore deserunt
                                                                accusantium amet earum soluta consequatur quasi eum eius
                                                                laboriosam, maiores praesentium explicabo enim dolores
                                                                quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam
                                                                officia, saepe repellat. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Start - Review Comment Reply-->
                                                <ul class="comment-reply">
                                                    <li class="comment-reply-list">
                                                        <div class="comment-wrapper">
                                                            <div class="comment-img">
                                                                <img src="assets/images/user/image-2.png" alt="">
                                                            </div>
                                                            <div class="comment-content">
                                                                <div class="comment-content-top">
                                                                    <div class="comment-content-left">
                                                                        <h6 class="comment-name">Oaklee Odom</h6>
                                                                    </div>
                                                                    <div class="comment-content-right">
                                                                        <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                                    </div>
                                                                </div>

                                                                <div class="para-content">
                                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                                        adipisicing elit. Tempora inventore dolorem a
                                                                        unde modi iste odio amet, fugit fuga aliquam,
                                                                        voluptatem maiores animi dolor nulla magnam ea!
                                                                        Dignissimos aspernatur cumque nam quod sint
                                                                        provident modi alias culpa, inventore deserunt
                                                                        accusantium amet earum soluta consequatur quasi
                                                                        eum eius laboriosam, maiores praesentium
                                                                        explicabo enim dolores quaerat! Voluptas ad
                                                                        ullam quia odio sint sunt. Ipsam officia, saepe
                                                                        repellat. </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul> <!-- End - Review Comment Reply-->
                                            </li> <!-- End - Review Comment list-->
                                            <!-- Start - Review Comment list-->
                                            <li class="comment-list">
                                                <div class="comment-wrapper">
                                                    <div class="comment-img">
                                                        <img src="assets/images/user/image-3.png" alt="">
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="comment-content-top">
                                                            <div class="comment-content-left">
                                                                <h6 class="comment-name">Jaydin Jones</h6>
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
                                                            </div>
                                                            <div class="comment-content-right">
                                                                <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                            </div>
                                                        </div>

                                                        <div class="para-content">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                Tempora inventore dolorem a unde modi iste odio amet,
                                                                fugit fuga aliquam, voluptatem maiores animi dolor nulla
                                                                magnam ea! Dignissimos aspernatur cumque nam quod sint
                                                                provident modi alias culpa, inventore deserunt
                                                                accusantium amet earum soluta consequatur quasi eum eius
                                                                laboriosam, maiores praesentium explicabo enim dolores
                                                                quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam
                                                                officia, saepe repellat. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> <!-- End - Review Comment list-->
                                        </ul> <!-- End - Review Comment -->
                                        <div class="review-form">
                                            <div class="review-form-text-top">
                                                <h5>ADD A REVIEW</h5>
                                                <p>Your email address will not be published. Required fields are marked
                                                    *</p>
                                            </div>

                                            <form action="#" method="post">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="default-form-box">
                                                            <label for="comment-name">Your name <span>*</span></label>
                                                            <input id="comment-name" type="text"
                                                                   placeholder="Enter your name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="default-form-box">
                                                            <label for="comment-email">Your Email <span>*</span></label>
                                                            <input id="comment-email" type="email"
                                                                   placeholder="Enter your email" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="default-form-box">
                                                            <label for="comment-review-text">Your review
                                                                <span>*</span></label>
                                                            <textarea id="comment-review-text"
                                                                      placeholder="Write a review" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="btn btn-md btn-black-default-hover"
                                                                type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                            </div>
                        </div> <!-- End Product Details Tab Content -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Content Tab Section -->
    <!-- Start Modal Add cart -->
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
                                        <li><strong><i class="icon-shopping-cart"></i> There Are 5 Items In Your
                                                Cart.</strong></li>
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
                var quantity = $('#quantity').val();
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
