@extends('front.layouts.layout')

@section('content')
@php
$direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
@endphp

{{-- Slider Section --}}

@include('front.home.slider')

{{-- Slider Section --}}

<br>
<section class="container d-flex flex-column gap-3">
    <br>
    <h1 class="text-center">{{ __('message.new') }}</h1>
    <br>
    <div class="slider_two  owl-carousel owl-theme">
        @foreach ($products as $product)
        @php
            $translation = $product->translation($selectedLanguage);
            $hasDiscount = $product->discount > 0;
            $finalPrice = $hasDiscount ? $product->price  - $product->discount  : $product->price;
        @endphp
        <div class="product__item">
            <a href="{{ url('singleProduct/'. $product->id) }}">
            <div class="product__item__pic set-bg" data-setbg="{{ asset($product->image) }}">
            </div>
            </a>
            <div class="product__item text-center" style="gap: 20px;">
                <br>
                <h6>{{ $translation->title }}</h6>
                <div style="display: flex; flex-direction:row; justify-content:center; gap:25px; font-size:14px" class="text-center">
                    @if($hasDiscount)
                    <h5 style="font-size: 14px; text-decoration: line-through; color: red;">
                        {{ $product->price }} {{ __('message.EGP') }}
                    </h5>
                    <h5 style="font-size: 14px;" class="text-center {{ $direction }}">
                        {{ $finalPrice  }} {{ __('message.EGP') }}
                    </h5>
                @else
                    <h5 style="font-size: 14px;" class="text-center {{ $direction }}">
                        {{ $product->price }} {{ __('message.EGP') }}
                    </h5>
                @endif
                </div>
                    <button type="submit" class="btn btn-secondary add-to-cart-btn"
                        data-product-id="{{ $product->id }}"
                        data-url="{{ route('cart.add') }}"
                        >{{ __('message.add_to_cart') }}
                    </button>
                </div>
        </div>
        @endforeach
    </div>
</section>

<br>

{{-- First Banner  --}}

@include('front.home.firstBanner')

{{-- First Banner  --}}

<!-- Product Section Begin -->
<br>
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">{{ __('message.top') }}</h1>
            </div>
        </div>
        <br>
        <div class="row product__filter">
            @foreach ($topProducts as $topProduct)
            @php
                $translation = $topProduct->translation($selectedLanguage);
                $hasDiscount = $product->discount > 0;
                $finalPrice = $hasDiscount ? $product->price - $product->discount : $product->price;
            @endphp
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    <a href="{{ url('singleProduct/'. $topProduct->id) }}">
                    <div class="product__item__pic set-bg"
                        data-setbg="{{ asset($topProduct->image) }}">
                    </div>
                    </a>
                    <div class="product__item text-center">
                        <br>
                        <h6>{{ $translation->title }}</h6>
                        {{-- <a href="#" class="add-cart">+ Add To Cart</a> --}}
                        <div class="{{ $direction }}" style="display: flex; flex-direction:row; justify-content:center; gap:15px; font-size:14px">

                            @if($hasDiscount)
                            <h5 class="{{ $direction }}" style="font-size: 14px; text-decoration: line-through; color: red;">
                                {{ $product->price }} {{ __('message.EGP') }}
                            </h5>
                            <h5 style="font-size: 14px;" class="text-center {{ $direction }}">
                                {{ $finalPrice }} {{ __('message.EGP') }}
                            </h5>
                            @else
                                <h5 style="font-size: 14px;" class="text-center {{ $direction }}">
                                    {{ $product->price }} {{ __('message.EGP') }}
                                </h5>
                            @endif
                            </div>

                        <button type="submit" class="btn btn-secondary add-to-cart-btn"
                            data-product-id="{{ $product->id }}"
                            data-url="{{ route('cart.add') }}"
                            >{{ __('message.add_to_cart') }}
                        </button>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product__pagination">
                    {{ $topProducts->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<br>

{{-- Second Banner --}}

@include('front.home.secondBanner')

{{-- Second Banner --}}

<br>

<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">{{ __('message.category') }}</h1>
            </div>
        </div>
        <br>
        <div class="row product__filter">
            @foreach ($categories as $category)
            @php
                $translation = $category->translation($selectedLanguage);
            @endphp
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    <a href="{{ url('shop/') }}">
                    <div class="product__item__pic set-bg"
                        data-setbg="{{ asset($category->image) }}">
                    </div>
                    </a>
                    <div class="product__item__text text-center">
                        <h5>{{ $translation->name }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<br>

{{-- Third Banner --}}

@include('front.home.thirdBanner')

{{-- Third Banner --}}



{{-- Blog Section  --}}

@include('front.home.blog')

{{-- Blog Section  --}}


<section class="social-section">
    <div class="container">
        <h2>{{ __('message.socail') }}</h2>
        <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=61562379203184"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/gomla_med/?hl=en"><i class="fab fa-instagram"></i></a>
        </div>
        <p>{{ __('message.know') }}</p>
    </div>
</section>

@endsection