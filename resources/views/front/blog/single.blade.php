@extends('front.layouts.layout')
@section('content')
    <!-- Blog Details Hero Begin -->
    <section class="blog-hero spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="blog__hero__text">
                        @php
                        $translation = $blog->translation($selectedLanguage);
                        @endphp
                        <h2>{{ $translation->title }}</h2>
                        <ul>
                            <li>{{ $blog->date }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">
                    <div class="blog__details__pic">
                        <img src="{{ asset($blog->image) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog__details__content">
                        <div class="blog__details__text">
                            <p class="text-center">{{ $translation->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection