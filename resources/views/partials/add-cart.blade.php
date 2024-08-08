<div id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->

    <!-- Start  Offcanvas Addcart Wrapper -->
    <div class="offcanvas-add-cart-wrapper">
        <h4 class="offcanvas-title">Shopping Cart</h4>
        @if(auth()->check())
            <ul class="offcanvas-cart">
                @foreach($cartItems as $item)
                    <li class="offcanvas-cart-item-single">
                        <div class="offcanvas-cart-item-block">
                            <a href="#" class="offcanvas-cart-item-image-link">
                                <img src="{{ asset('admin/product/'. $item->product->productImage[0]->image) }}" alt=""
                                     class="offcanvas-cart-image">
                            </a>
                            <div class="offcanvas-cart-item-content">
                                <a href="#" class="offcanvas-cart-item-link">{{ $item->product->name }}</a>
                                <div class="offcanvas-cart-item-details">
                                    <span class="offcanvas-cart-item-details-quantity">{{ $item->quantity }} x </span>
                                    <span class="offcanvas-cart-item-details-price">৳ {{ $item->price }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="offcanvas-cart-item-delete text-right">
                            <a href="#" class="offcanvas-cart-item-delete cart-delete" data-cart-id="{{ $item->id }}"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="offcanvas-cart-total-price">
                <span class="offcanvas-cart-total-price-text">Subtotal:</span>
                <span class="offcanvas-cart-total-price-value">৳ {{ $subtotal }}</span>
            </div>
            <ul class="offcanvas-cart-action-button">
                <li><a id="checkout-button" href="{{ route('user.checkout') }}" class="btn btn-block btn-pink mt-5">Checkout</a></li>
            </ul>
        @else
            <h1>You Have to Login First</h1>
        @endif
    </div> <!-- End  Offcanvas Addcart Wrapper -->

</div>

