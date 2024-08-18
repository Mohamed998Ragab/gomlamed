@extends('front.layouts.layout')
@section('content')
@php
$direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
@endphp
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb {{ $direction }}">
                            <a href="{{ url('/') }}">{{ __('message.home') }}</a>
                            <a href="{{ url('/shop') }}">{{ __('message.shop') }}</a>
                            <span>{{ __('message.details') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item center">
                                    <img src="{{ asset($product->image) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
        $translation = $product->translation($selectedLanguage);
        $hasDiscount = $product->discount > 0;
        $finalPrice = $hasDiscount ? $product->price * ((100 - $product->discount) / 100) : $product->price;
        @endphp
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $translation->title }}</h4>
                            <p>{{ $translation->description }}</p>
                            @if($hasDiscount)
                            <h5 class="{{ $direction }}" style="font-size: 14px; text-decoration: line-through; color: red;">
                                {{ $product->price }} {{ __('message.EGP') }}
                            </h5>
                            <h5 style="font-size: 14px;" class="text-center {{ $direction }}">
                                {{ number_format($finalPrice, 2) }} {{ __('message.EGP') }}
                            </h5>
                            @else
                                <h5 style="font-size: 14px;" class="text-center {{ $direction }}">
                                    {{ $product->price }} {{ __('message.EGP') }}
                                </h5>
                            @endif                            <div class="product__details__cart__option">
                                <button type="submit" class="btn btn-secondary add-to-cart-btn"
                                data-product-id="{{ $product->id }}"
                                data-url="{{ route('cart.add') }}"
                                >{{ __('message.add_to_cart') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->
@endsection