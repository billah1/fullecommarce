@extends('welcome')
@section('content')
    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Checkout</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                    <li class="active" aria-current="page">Checkout</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Checkout Section:::... -->
    <div class="checkout-section">
        <div class="container">
            <div class="row">
                <!-- User Quick Action Form -->
                <div class="col-12" id="successMessage" style="display: none; margin-bottom: 5px">
                    <div class="text-white p-4 rounded-lg shadow-md" style="background-color: #0f5133;" data-aos="fade-up" data-aos-delay="200">
                        <h4 class="flex items-center text-lg font-semibold" style="color:white;">
                            <i class="fa fa-check mr-2"></i>
                            Coupon Applied Successfully
                        </h4>
                    </div>
                </div>

                <div class="col-12" id="couponPart">
                    <div class="user-actions accordion" data-aos="fade-up" data-aos-delay="200">
                        <h3>
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            Have a coupon?
                            <a class="Returning" href="#" data-bs-toggle="collapse" data-bs-target="#checkout_coupon"
                               aria-expanded="true">Click here to enter your code</a>

                        </h3>
                        <div id="checkout_coupon" class="collapse checkout_coupon" data-parent="#checkout_coupon">
                            <div class="checkout_info">
                                <form id="couponForm">
                                    <input placeholder="Coupon code" name="coupon" id="couponCode" type="text">
                                    <input id="subtotal" value="{{ $subtotal }}" type="text" hidden>
                                    <button class="btn btn-md btn-black-default-hover" type="submit">Apply
                                        coupon
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Quick Action Form -->
            </div>
            <!-- Start User Details Checkout Form -->
            <div class="checkout_form" data-aos="fade-up" data-aos-delay="400">
                <form action="{{ route('user.checkout.purchase') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="default-form-box">
                                        <label>Full Name <span>*</span></label>
                                        <input type="text" name="full_name" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="default-form-box">
                                        <label>Company Name</label>
                                        <input type="text" name="company_name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="default-form-box">
                                        <label for="country">country <span>*</span></label>
                                        <select class="country_option nice-select wide" name="country" id="country">
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="default-form-box">
                                        <label>Street address <span>*</span></label>
                                        <input placeholder="House number and street name" type="text" name="address1"
                                               required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="default-form-box">
                                        <input placeholder="Apartment, suite, unit etc. (optional)" type="text"
                                               name="address2">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="default-form-box">
                                        <label>Town / City <span>*</span></label>
                                        <input type="text" name="town_city" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="default-form-box">
                                        <label>Phone<span>*</span></label>
                                        <input type="text" name="phone" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="default-form-box">
                                        <label> Email Address <span>*</span></label>
                                        <input type="email" name="email" value="{{ auth()->user()->email }}" required>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="order-notes">
                                        <label for="order_note">Order Notes</label>
                                        <textarea id="order_note" name="note"
                                                  placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                                <input name="discount" id="discount" hidden>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <form action="#">
                                <h3>Your order</h3>
                                <div class="order_table table-responsive">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td> {{ $item->product->name }} <strong>
                                                        × {{ $item->quantity }}</strong></td>
                                                <td> ৳ {{ $item->total_price }}</td>
                                            </tr>
                                            <input type="hidden" name="cart_ids[]" value="{{ $item->id }}">
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Cart Subtotal</th>
                                            <td id="cartSubtotal"> ৳ {{ $subtotal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td id="shipping"><strong> ৳ 0</strong></td>
                                        </tr>
                                        <tr class="order_total">
                                            <th>Order Total</th>
                                            <td><strong> ৳ {{ $subtotal }}</strong></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <input type="hidden" name="total_charge" id="total_charge" value="{{ $subtotal }}">
                                <div class="payment_method">
                                    <div class="panel-default">
                                        <label class="checkbox-default" for="currencyCod" data-bs-toggle="collapse"
                                               data-bs-target="#methodCod">
                                            <input type="radio" id="currencyCod" name="payment_type">
                                            <span>Cash on Delivery</span>
                                        </label>

                                        <div id="methodCod" class="collapse" data-parent="#methodCod">

                                        </div>
                                    </div>
                                    <div class="panel-default">
                                        <label class="checkbox-default" for="currencyPaypal" data-bs-toggle="collapse"
                                               data-bs-target="#methodPaypal">
                                            <input type="radio" id="currencyPaypal" name="payment_type" disabled>
                                            <span>Online Payment</span>
                                        </label>
                                        <div id="methodPaypal" class="collapse " data-parent="#methodPaypal">

                                        </div>
                                    </div>
                                    <div class="order_button pt-3">
                                        <button class="btn btn-md btn-black-default-hover" type="submit">Proceed
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- Start User Details Checkout Form -->
    </div>
    <!-- ...:::: End Checkout Section:::... -->
@endsection
@push('js')
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    <script>
        document.getElementById('couponForm').addEventListener('submit', function (event) {
            event.preventDefault();

            var couponCode = document.getElementById('couponCode').value;
            var subtotal = document.getElementById('subtotal').value;

            // Using Axios to send a POST request
            axios.post('/apply-coupon', {
                coupon: couponCode,
                subtotal: subtotal
            }, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                }
            })
                .then(function (response) {
                    // Handle success
                    if (response.data.success) {
                        document.getElementById('cartSubtotal').innerText = '৳ ' + response.data.newSubtotal + ' (' + response.data.discount + '% discount' + ')';
                        calculateAndUpdateOrderTotal();
                        toastr.success('Coupon Applied Successfully!', 'Coupon')
                        document.getElementById('couponPart').style.display = 'none';
                        // Show the success message
                        document.getElementById('successMessage').style.display = 'block';
                        document.getElementById('discount').value = response.data.discount;
                    } else {
                        // Handle error (e.g., invalid coupon)
                        toastr.error('Coupon Not Valid!', 'Coupon')
                    }
                })
                .catch(function (error) {
                    // Handle error
                    // console.error('Error:', error);
                    toastr.error('Coupon Not Valid!', 'Coupon')
                });
        });
    </script>
    <script>
        function calculateAndUpdateOrderTotal() {
            let subtotalText = document.getElementById('cartSubtotal').innerText;
            let subtotalValue = parseFloat(subtotalText.replace(/[^ \d\.]/g, ''));
            let shippingText = document.getElementById('shipping').innerText;
            let shippingValue = parseFloat(shippingText.replace(/[^\d\.]/g, ''));

            let orderTotal = subtotalValue + shippingValue;

            document.querySelector('.order_total td').innerText = '৳ ' + orderTotal.toFixed(2);

            document.getElementById('total_charge').value = orderTotal.toFixed(2);
        }

        calculateAndUpdateOrderTotal();
    </script>
@endpush
