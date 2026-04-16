{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Authentication -->
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('admin.logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('vendor-dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        @php
            $kycStatus = auth('web')->user()->kyc?->status;
        @endphp
        @if ($kycStatus === 'pending')
                <div class="alert alert-important alert-warning alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/alert-triangle -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon alert-icon icon-2">
                            <path d="M12 9v4" />
                            <path
                                d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                            <path d="M12 16h.01" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="alert-heading">Your KYC is Pending</h4>
                        <span class="alert-description">Please wait for admin to approve your KYC
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

    @if ($kycStatus === 'rejected' || $kycStatus === null)
        <div class="alert alert-important alert-danger alert-dismissible" role="alert" style="width:100%;">
            <div class="alert-icon">
                <!-- Download SVG icon from http://tabler.io/icons/icon/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon alert-icon icon-2">
                    <path d="M12 9v4" />
                    <path
                        d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                    <path d="M12 16h.01" />
                </svg>

            </div>
            <div class="d-flex w-100 flex-column flex-md-row align-items-md-center justify-content-between me-4">
                <div>
                    <h4 class="alert-heading mb-0">
                        {{ $kycStatus === 'rejected' ? 'Your KYC rejected' : 'Please submit your KYC' }}
                    </h4>
                    <span class="alert-description">
                        {{ $kycStatus === 'rejected'
                    ? 'Re-submit your KYC to get started'
                    : 'Submit your KYC to get started' }}
                    </span>
                </div>
                <div class="mt-3 mt-md-0 text-end">
                    <a href="{{ route('kyc.index') }}" class="btn bg-white text-dark fw-bold shadow-sm" style="border: none;">
                        {{ $kycStatus === 'rejected' ? 'Re-submit KYC Now' : 'Submit KYC Now' }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right ms-2 me-0"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l14 0"></path>
                            <path d="M13 18l6 -6"></path>
                            <path d="M13 6l6 6"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    @endif
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="row row-cards">
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                            <path d="M12 3v3m0 12v3" />
                                        </svg></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">132 Sales</div>
                                    <div class="text-secondary">12 waiting payments</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/shopping-cart -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="icon icon-1">
                                            <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 17h-11v-14h-2" />
                                            <path d="M6 5l14 1l-1 7h-13" />
                                        </svg></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">78 Orders</div>
                                    <div class="text-secondary">32 shipped</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-x text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/brand-x -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="icon icon-1">
                                            <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                            <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                                        </svg></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">623 Shares</div>
                                    <div class="text-secondary">16 today</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/brand-facebook -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                        </svg></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">132 Likes</div>
                                    <div class="text-secondary">21 today</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection