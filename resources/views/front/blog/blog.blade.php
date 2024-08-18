@extends('front.layouts.layout')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-blog set-bg" data-setbg="{{ asset('front/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{ __('message.blog') }}</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                @php
                    $translation = $blog->translation($selectedLanguage);
                @endphp
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item text-center">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset($blog->image) }}"></div>
                        <div class="blog__item__text">
                            <span><img src="{{ asset('front/img/icon/calendar.png') }}" alt="">{{ $blog->date }}</span>
                            <h5>{{ $translation->title }}</h5>
                            <a href="{{ url('singleBlog/'. $blog->id) }}">{{ __('message.read_more') }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__pagination">
                        {{ $blogs->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection