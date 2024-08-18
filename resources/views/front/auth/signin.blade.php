@extends('front.layouts.layout')
@section('content')

@php
$direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
@endphp

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row {{ $direction }}">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>{{ __('message.sign_in') }}</h4>
                        <div class="breadcrumb__links {{ $direction }}">
                            <a href="{{ url('/') }}">{{ __('message.home') }}</a>
                            <a href="{{ url('/signIn') }}">{{ __('message.sign_in') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad {{ $direction }}">
        <div class="container {{ $direction }}">
            <div class="checkout__form {{ $direction }}">
                <form action="{{ route('login') }}"  method="POST"> @csrf
                    <div class="row {{ $direction }}">
                        <div class="col-lg-8 col-md-6 {{ $direction }}">
                            <h6 class="coupon__code"><span class="icon_tag_alt {{ $direction }}"></span> {{ __('message.account') }} <a href="{{ url('/register') }}">
                                {{ __('message.click_here') }}</a> {{ __('message.register') }}</h6>
                            <h6 class="checkout__title">{{ __('message.sign_in') }}</h6>
                            <div class="checkout__input">
                                <p>{{ __('message.email') }}<span>*</span></p>
                                <input type="email" name="email" required>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="checkout__input">
                                <p>{{ __('message.password') }}<span>*</span></p>
                                <input type="password" name="password" required >
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
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