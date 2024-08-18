{{-- @extends('front.layouts.layout')
@section('content')
@php
$direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
@endphp
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option {{ $direction }}">
        <div class="container {{ $direction }}">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>{{ __('message.check') }}</h4>
                        <div class="breadcrumb__links {{ $direction }}">
                            <a href="{{ url('/') }}">{{ __('message.home') }}</a>
                            <a href="{{ url('/shop') }}">{{ __('message.shop') }}</a>
                            <span>{{ __('message.check') }}</span>
                            @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ route('checkout.placeOrder') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">{{ __('message.check') }} </h6>
                            <div class="checkout__input">
                                <p>{{ __('message.address') }}<span>*</span></p>
                                <input type="text" name="address" placeholder="{{ __('message.address') }}" class="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <div class="checkout__order  ">
                                <h4 class="order__title">{{ __('message.your_order') }}</h4>
                                <div class="checkout__order__products">{{ __('message.product') }} <span>{{ __('message.total') }}</span></div>
                                <ul class="checkout__total__products">
                                    @foreach($cartItems as $item)
                                    @php
                                        $translation = $item->product->translation(app()->getLocale());
                                    @endphp
                                    <li> {{ $translation->title }} <span>{{ $item->quantity }} x {{ __('message.EGP') }}{{ $item->product->price }} = {{ __('message.EGP') }} {{ $item->quantity * $item->product->price }}</span></li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>{{ __('message.total') }} <span>{{ $cartItems->sum(function($item) { return $item->product->price * $item->quantity; }) }} {{ __('message.EGP') }}</span></li>
                                </ul>
                                <button type="submit" class="site-btn">{{ __('message.verify_order') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection --}}

@extends('front.layouts.layout')
@section('content')
@php
$direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
@endphp
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option {{ $direction }}">
        <div class="container {{ $direction }}">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>{{ __('message.check') }}</h4>
                        <div class="breadcrumb__links {{ $direction }}">
                            <a href="{{ url('/') }}">{{ __('message.home') }}</a>
                            <a href="{{ url('/shop') }}">{{ __('message.shop') }}</a>
                            <span>{{ __('message.check') }}</span>
                            @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ route('checkout.placeOrder') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">{{ __('message.check') }} </h6>
                            <div class="checkout__input">
                                <p>{{ __('message.address') }}<span>*</span></p>
                                <input type="text" name="address" placeholder="{{ __('message.address') }}" class="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <div class="checkout__order  ">
                                <h4 class="order__title">{{ __('message.your_order') }}</h4>
                                <div class="checkout__order__products">{{ __('message.product') }} <span>{{ __('message.total') }}</span></div>
                                <ul class="checkout__total__products">
                                    @foreach($cartItems as $item)
                                    @php
                                        $translation = $item->product->translation(app()->getLocale());
                                        $hasDiscount = $item->product->discount > 0;
                                        $finalPrice = $hasDiscount ? $item->product->price * ((100 - $item->product->discount) / 100) : $item->product->price;
                                    @endphp
                                    <li> {{ $translation->title }} <span>{{ $item->quantity }} x {{ __('message.EGP') }}{{ number_format($finalPrice, 2) }} = {{ __('message.EGP') }} {{ number_format($finalPrice * $item->quantity, 2) }}</span></li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>{{ __('message.total') }} <span>{{ __('message.EGP') }} {{ number_format($cartItems->sum(function($item) {
                                        $finalPrice = $item->product->discount > 0
                                            ? $item->product->price * ((100 - $item->product->discount) / 100)
                                            : $item->product->price;
                                        return $finalPrice * $item->quantity;
                                    }), 2) }}</span></li>
                                </ul>
                                <button type="submit" class="site-btn">{{ __('message.verify_order') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
