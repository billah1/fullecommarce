@extends('welcome')
@section('content')
    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Login</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                    <li class="active" aria-current="page">Login</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Customer Login Section :::... -->
    <div class="customer-login">
        <div class="container">
            <div class="row">
                <!--login area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form" data-aos="fade-up" data-aos-delay="0">
                        <h3>login</h3>
                        <form action="{{ route('user.auth.login') }}" method="POST">
                            @csrf
                            <div class="default-form-box">
                                <label>Email <span>*</span></label>
                                <input type="text" name="email" required>
                            </div>
                            <div class="default-form-box">
                                <label>Passwords <span>*</span></label>
                                <input type="password" name="password" required>
                            </div>
                            <div class="login_submit">
                                <button class="btn btn-md btn-black-default-hover mb-4" type="submit">login</button>
                                <label class="checkbox-default mb-4" for="offer">
                                    <input type="checkbox" id="offer">
                                    <span>Remember me</span>
                                </label>
                                <a href="#">Lost your password?</a>

                            </div>
                        </form>
                    </div>
                </div>
                <!--login area start-->

                <!--register area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register" data-aos="fade-up" data-aos-delay="200">
                        <h3>Register</h3>
                        <form action="{{ route('user.auth.register') }}" method="post">
                            @csrf
                            <div class="default-form-box">
                                <label>Full Name <span>*</span></label>
                                <input type="text" name="name" required>
                            </div>
                            <div class="default-form-box">
                                <label>Email address <span>*</span></label>
                                <input type="email" name="email" required>
                            </div>
                            <div class="default-form-box">
                                <label>Phone Number <span>*</span></label>
                                <input type="text" name="phone" required>
                            </div>
                            <div class="default-form-box">
                                <label>Passwords <span>*</span></label>
                                <input type="password" name="password" id="pass" required>
                            </div>
                            <div class="default-form-box">
                                <label>Confirm Passwords <span>*</span></label>
                                <input type="password" name="password_confirmation" id="confirmPass" required>
                                <span id="msg" hidden></span>
                            </div>
                            <div class="login_submit">
                                <button class="btn btn-md btn-black-default-hover" id="btnReg" type="submit">Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div> <!-- ...:::: End Customer Login Section :::... -->
@endsection
@push('js')
    <script>
        var pass = document.getElementById('pass');
        var confirmPass = document.getElementById('confirmPass');
        var msg = document.getElementById('msg');
        var btn = document.getElementById('btnReg');
        confirmPass.addEventListener('input', function () {
            if (pass.value === confirmPass.value) {
                msg.textContent = "Password matched";
                msg.style.color = 'green';
                msg.hidden = false;
                btn.disabled = false;
            } else {
                msg.textContent = "Password not matched";
                msg.style.color = 'red';
                msg.hidden = false;
                btn.disabled = true;
            }
        });
    </script>
@endpush
