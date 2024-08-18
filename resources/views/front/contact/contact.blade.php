@extends('front.layouts.layout')
@section('content')
    <!-- Contact Section Begin -->

    @php
    $direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
    @endphp

    <section class="contact spad">
            <!-- Display Success Message -->
            @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display Error Message -->
        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
        <div class="container">
            <div class="row {{ $direction }}">
                <div class="col-lg-6 col-md-6 {{ $direction }}">
                    <div class="contact__text {{ $direction }}">
                        <div class="section-title {{ $direction }}">
                            <span class="{{ $direction }}">{{ __('message.information') }}</span>
                            <h2 class="{{ $direction }}">{{ __('message.contact') }}</h2>
                            <p class="{{ $direction }}">{{ __('message.contact_description') }}</p>
                        </div>
                        <ul class="{{ $direction }}">
                            <li>
                                <h4>{{ __('message.number') }} :</h4>
                            </li>
                            <li>
                                <h6>- 01040129660</h6>
                                <h6>- 01040244179</h6>
                                <h6>- 01144664484</h6>
                                <h6>- 01152983123</h6>

                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 {{ $direction }}">
                    <div class="contact__form {{ $direction }}">
                        <form action="{{ route('contact.store') }}" method="POST"> @csrf
                            <div class="row {{ $direction }}">
                                <div class="col-lg-6">
                                    <label for="name" >Name</label>
                                    <input type="text" name="name" required >
                                </div>
                                <div class="col-lg-6">
                                    <label for="phone" >Phone</label>
                                    <input type="text" name="phone" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="email" >Email</label>
                                    <input type="text" name="email" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="name" >Message</label>
                                    <textarea name="message" required ></textarea>
                                    <button type="submit" class="site-btn {{ $direction }}">{{ __('message.send_message') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection