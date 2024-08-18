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
                    <div class="breadcrumb__text {{ $direction }}">
                        <h4>{{ __('message.shop') }}</h4>
                        <div class="breadcrumb__links {{ $direction }}">
                            <a href="{{ url('/') }}">{{ __('message.home') }}</a>
                            <span>{{ __('message.shop') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad {{ $direction }}">
        <div class="container {{ $direction }}">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search {{ $direction }}">
                            <form action="{{ route('shop') }}" method="GET">
                                <input type="text" name="search" value="{{ request()->query('search') }}">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion {{ $direction }}">
                            <div class="accordion {{ $direction }}" id="accordionExample">
                                <div class="card {{ $direction }}">
                                    <div class="card-heading {{ $direction }}">
                                        <br>
                                        <a data-toggle="collapse" data-target="#collapseOne">{{ __('message.category') }}</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show {{ $direction }}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    @foreach ($categories as $category)
                                                    @php
                                                        $translation = $category->translation($selectedLanguage);
                                                    @endphp
                                                    <li>
                                                        <a href="{{ route('shop', ['category' => $category->id]) }}">
                                                            {{ $translation->name }}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>{{ __('message.showing') }} {{ $products->firstItem() }}-{{ $products->lastItem() }} {{ __('message.of') }} {{ $products->total() }} {{ __('message.results') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                        @php
                            $translation = $product->translation($selectedLanguage);
                            $hasDiscount = $product->discount > 0;
                            $finalPrice = $hasDiscount ? $product->price * ((100 - $product->discount) / 100) : $product->price;
                        @endphp
                        <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 ">
                            <div class="product__item">
                                <a href = "{{ url('singleProduct/'.$product->id) }}">
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset($product->image) }}"></div>
                                </a>
                                <div class="product__item text-center {{ $direction }}">
                                    <br>
                                    <h6>{{ $translation->title }}</h6>
                                    <div style="display: flex; flex-direction:row; gap:15px; font-size:14px; justify-content:center;">
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
                                {{ $products->withQueryString()->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection
