<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gommla Medical</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<style>
        /* RTL (Right-to-Left) styles */
    .rtl {
        direction: rtl;
        text-align: right;
    }
    
    .banner_offers {
        background-color: #f8f8f8;
        color: white;
        padding: 60px 0;
        text-align: center;
    }

    .banner_offers h1 {
        font-size: 3em;
        margin-bottom: 20px;
    }

    .banner_offers p {
        font-size: 1.2em;
    }

    .banner_offers i {
        color: #000 !important;
    }

    @media (max-width: 768px) {
        .banner_offers h1 {
            font-size: 2em;
        }

        .banner_offers p {
            font-size: 1em;
        }
    }

    @media (max-width: 768px) {
        .banner_offers h1 {
            font-size: 2em;
        }

        .banner_offers p {
            font-size: 1em;
        }
    }

    .banner_offers .icon-box {
        text-align: center;
        margin-bottom: 30px;
    }

    .banner_offers .icon-box i {
        font-size: 3em;
        color: #007bff;
        margin-bottom: 10px;
    }

    .banner_offers .icon-box h4 {
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    .banner_offers .icon-box p {
        font-size: 1em;
        color: #6c757d;
    }

    .social-section {
            text-align: center;
            padding: 60px 0;
            background-color: #f8f8f8;
        }

        .social-section h2 {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .social-section .social-icons i {
            font-size: 2em;
            margin: 0 10px;
            color: #000;
        }

        .social-section p {
            margin-top: 20px;
            color: #6c757d;
        }

        .whatsapp-icon {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }

    .whatsapp-icon i {
        font-size: 55px;
        color: #25D366;
    }

    .whatsapp-icon a {
        text-decoration: none;
    }

    .whatsapp-icon:hover i {
        color: #128C7E;
    }
</style>




<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">{{ __('message.sign_in') }}</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>{{ $selectedLanguage }} <i class="arrow_carrot-down"></i></span>
                <ul>
                    @foreach (\App\Models\Language::all() as $language)
                        <li>
                            <a href="{{ route('setLanguage', ['lang' => $language->code]) }}">
                                {{ $language->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- <div class="offcanvas__nav__option">
            <a href="#"><img src="{{ asset('front/img/icon/cart.png') }}" alt=""> <span>500</span></a>
            <div class="price">100</div> 1000
        </div> --}}
        <div class="offcanvas__nav__option">
            <a href="{{ route('cart.view') }}">
                <img src="{{ asset('front/img/icon/cart.png') }}" alt="">
                <span>{{ $cartCount }}</span>
            </a>
            <div>${{ number_format($cartTotal, 2) }}</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            {{-- <p>Free shipping, 30-day return or refund guarantee.</p> --}}
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    @include('front.layouts.header')
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    @yield('content')

    <!-- Footer Section Begin -->
    @include('front.layouts.footer')
    <!-- Footer Section End -->

    <!-- Search Begin -->
    {{-- @include('front.layouts.search') --}}


    <div class="whatsapp-icon">
        <a href="https://wa.me/01040129660" target="_blank" title="Chat with us on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    
    <div id="toast-container" aria-live="polite" aria-atomic="true" style="position: fixed; bottom: 20px; left: 20px; z-index: 1055;">
        <!-- Toast -->
        <div id="toast-message" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <!-- The message will be dynamically inserted here by JavaScript -->
            </div>
        </div>
    </div>
    
    
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('front/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>
</body>


</html>
