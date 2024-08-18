@extends('front.layouts.layout')

@section('content')

@php
$direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
@endphp
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text {{ $direction  }}">
                        <h4>{{ __('message.shop_cart') }}</h4>
                        <div class="breadcrumb__links {{ $direction  }}">
                            <a href="{{ url('/') }}">{{ __('message.home') }}</a>
                            <a href="{{ url('/shop') }}">{{ __('message.shop') }}</a>
                            <span class="{{ $direction  }}">{{ __('message.shop_cart') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad {{ $direction  }}">
        <div class="container {{ $direction  }}">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        <table class="{{ $direction  }}">
                            <thead>
                                <tr>
                                    <th>{{ __('message.image') }}</th>
                                    <th>{{ __('message.product') }}</th>
                                    <th>{{ __('message.quantity') }}</th>
                                    <th>{{ __('message.total') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cartItems as $item)
                                    @php
                                        $translation = $item->product->translation($selectedLanguage);
                                        $hasDiscount = $item->product->discount > 0;
                                        $finalPrice = $hasDiscount ? $item->product->price - $item->product->discount : $item->product->price;
                                    @endphp
                                    <tr>
                                        <td class="product__cart__item">
                                            <img style="width:150px; height:120px;" src="{{ asset($item->product->image) }}" alt="{{ $translation->title }}">
                                        </td>
                                        <td>
                                            <h6>{{ $translation->title }}</h6>
                                            @if($hasDiscount)
                                            <h3 style="font-size: 16px; text-decoration: line-through; color: red;">
                                                {{ $item->product->price }} {{ __('message.EGP') }}
                                            </h3>
                                            <h3 style="font-size: 16px;">
                                                {{ $finalPrice }} {{ __('message.EGP') }}
                                            </h3>
                                        @else
                                            <h3 style="font-size: 16px;">
                                                {{ $finalPrice }} {{ __('message.EGP') }}
                                            </h3>
                                        @endif
                                            {{-- <h3 style="font-size: 16px;">{{ $item->product->price }} {{ __('message.EGP') }}</h3> --}}
                                        </td>
                                        <td class="quantity__item">
                                            <form action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                                <input class="form-control" style="width: 80px;" type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                                                <button type="submit" class="btn btn-secondary mt-2">{{ __('message.update') }}</button>
                                            </form>
                                        </td>
                                        <td class="cart__price">
                                            {{ $finalPrice * $item->quantity }} {{ __('message.EGP') }}
                                        </td>
                                        <td class="cart__close">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-secondary"><i class="fa fa-close"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Your cart is empty.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ url('/shop') }}">{{ __('message.continue_shop') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 {{ $direction }}">
                    <div class="cart__total {{ $direction }}">
                        <h6>{{ __('message.cart_total') }}</h6>
                        <ul class="{{ $direction }}">
                            {{-- <li  class="{{ $direction }}" >{{ __('message.total') }} <br> <span>{{ $cartItems->sum(function($item) { return $item->product->price * $item->quantity; }) }} {{ __('message.EGP') }}</span></li> --}}
                            <li class="{{ $direction }}">
                                {{ __('message.total') }} <br>
                                <span>
                                    {{ $cartItems->sum(function($item) {
                                        $finalPrice = $item->product->discount > 0
                                            ? $item->product->price - $item->product->discount
                                            : $item->product->price;
                                        return $finalPrice * $item->quantity;
                                    }) }} {{ __('message.EGP') }}
                                </span>
                            </li>
                        </ul>
                        <a href="{{ url('/checkout') }}" class="primary-btn">{{ __('message.check_out') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
