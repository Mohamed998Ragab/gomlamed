@extends('front.layouts.layout')
@section('content')

@php
$direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
@endphp

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container {{ $direction }}">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text {{ $direction }}">
                        <h4>{{ __('message.register') }}</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ url('/') }}">{{ __('message.home') }}</a>
                            <a href="{{ url('/register') }}">{{ __('message.register') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad  {{ $direction }}">
        <div class="container  {{ $direction }}">
            <div class="checkout__form">
                <form action="{{ route('register') }}" method="POST"> @csrf
                    <div class="row  {{ $direction }}">
                        <div class="col-lg-8 col-md-6">
                            {{-- <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                            here</a> to enter your code</h6> --}}
                            <h6 class="checkout__title">{{ __('message.register') }}</h6>
                            <div class="checkout__input">
                                <p>{{ __('message.name') }}<span>*</span></p>
                                <input type="text" name="name" required>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="checkout__input">
                                <p>{{ __('message.email') }}<span>*</span></p>
                                <input type="email" name="email" required>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="checkout__input">
                                <p>{{ __('message.phone') }}<span>*</span></p>
                                <input type="text" name="phone" required >
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                            <div class="checkout__input">
                                <p>{{ __('message.password') }}<span>*</span></p>
                                <input type="password" name="password" required >
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="checkout__input">
                                <p>{{ __('message.confirm') }}<span>*</span></p>
                                <input type="password" name="password_confirmation" required >
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            <div class="checkout__input">
                                <button type="submit" class="btn btn-secondary w-100">{{ __('message.sumbit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection