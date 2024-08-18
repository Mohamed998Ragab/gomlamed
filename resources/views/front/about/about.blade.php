@extends('front.layouts.layout')
@section('content')

@php
$direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
@endphp

<section class="breadcrumb-option {{ $direction }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>{{ __('message.about') }}</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}">{{ __('message.home') }}</a>
                        <span>{{ __('message.about') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- About Section Begin -->
<section class="about spad">
    <div class="container center">
        <div class="row">
            <div class="col-lg-12">
                <div class="about__pic">
                    <img src="{{ asset($about->image) }}" alt="">
                </div>
            </div>
        </div>
        <div class="row text-center">
            @php
            $translation = $about->translation($selectedLanguage);
            @endphp
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>{{ $translation->first_title }}</h4>
                    <p>{{ $translation->first_description }}</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>{{ $translation->second_title }}</h4>
                    <p>{{ $translation->second_description }}</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>{{ $translation->third_title }}</h4>
                    <p>{{ $translation->third_description }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->

    <!-- Counter Section Begin -->

    <!-- Counter Section End -->

    @include('front.home.secondBanner')


@endsection