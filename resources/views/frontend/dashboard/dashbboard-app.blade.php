@extends('frontend.layouts.app')
@section('contents')
    <x-frontend.breadcrumb :items="[
        ['url' => '/', 'label' => 'Home', 'icon' => 'fa-solid fa-house'],
        ['label' => 'Dashboard', 'icon' => 'fa-solid fa-right-to-bracket'],
    ]" />
    <div class="page-content pt-70 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true"><i
                                                class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i
                                                class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i
                                                class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="false"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}"><i class="fi-rs-user mr-10"></i>Account
                                            details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="wishlist-tab" data-bs-toggle="tab" href="#wishlist" role="tab" aria-controls="wishlist" aria-selected="false"><i class="fi-rs-heart mr-10"></i>
                                            Wishlist</a>
                                    </li>
                                    <li class="nav-item">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <a class="nav-link" href="#"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="fi-rs-sign-out mr-10"></i>Logout
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                @yield('dashboard_contents')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
