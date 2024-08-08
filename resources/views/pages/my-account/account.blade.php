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
                        <h3 class="breadcrumb-title">My Account</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                    <li class="active" aria-current="page">My Account</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Account Dashboard Section:::... -->
    <div class="account-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li><a href="#dashboard" data-bs-toggle="tab"
                                   class="nav-link btn btn-block btn-md btn-black-default-hover active">Dashboard</a>
                            </li>
                            <li> <a href="#orders" data-bs-toggle="tab"
                                    class="nav-link btn btn-block btn-md btn-black-default-hover">Orders</a></li>
                            <li><a href="#address" data-bs-toggle="tab"
                                   class="nav-link btn btn-block btn-md btn-black-default-hover">Addresses</a></li>
                            <li><a href="#account-details" data-bs-toggle="tab"
                                   class="nav-link btn btn-block btn-md btn-black-default-hover">Account details</a>
                            </li>
                            <li>
                                <form action="{{ route('user.auth.logout') }}" method="post">
                                    @csrf
                                <button type="submit"
                                   class="nav-link btn btn-block btn-md btn-black-default-hover">logout</button>
                                </form></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                        @include('pages.my-account.tab-content.dashboard')
                        @include('pages.my-account.tab-content.orders')
                        @include('pages.my-account.tab-content.address')
                        @include('pages.my-account.tab-content.account-details')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ...:::: End Account Dashboard Section:::... -->
@endsection
@push('js')

@endpush
