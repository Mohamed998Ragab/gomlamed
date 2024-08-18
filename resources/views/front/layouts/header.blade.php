<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        {{-- <p>Free shipping, 30-day return or refund guarantee.</p> --}}
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        {{-- <div class="header__top__links">
                            <a href="#">+ 011463664666</a>
                            <a href="{{ url('/login') }}">{{ __('message.sign_in') }}</a>
                        </div> --}}
                        <div class="header__top__links">
                            <a href="tel:+01144664484">+ 01144664484</a>             
                                       
                            @if(Auth::check())
                                <a href="#">{{ Auth::user()->name }}</a>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('message.logout') }}
                                </a>
                        
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ url('/login') }}">{{ __('message.sign_in') }}</a>
                                <a href="{{ url('/register') }}">{{ __('message.register') }}</a>
                            @endif
                        </div>
                        
                        <div class="header__top__hover">
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
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div style="padding: 15px !important;" class="header__logo">
                    <a href="{{ url('/') }}" >
                    <img style="width: 70px; height:50px;" src="{{ asset('front/img/Gomla.png') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">{{ __('message.home') }}</a></li>
                        <li class="{{ Request::is('shop') ? 'active' : '' }}"><a href="{{ url('/shop') }}">{{ __('message.shop') }}</a></li>
                        <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{ url('/about') }}">{{ __('message.about') }}</a></li>
                        <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}">{{ __('message.contact') }}</a></li>
                        <li class="{{ Request::is('blog') ? 'active' : '' }}"><a href="{{ url('/blog') }}">{{ __('message.blog') }}</a></li>
                    </ul>
                </nav>
            </div>
            
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option" style="display: flex; flex-direction:row; justify-content:center; align-items:center; gap:15px;" >
                    <a href="{{ url('/cart') }}"><img src="{{ asset('front/img/icon/cart.png') }}" alt=""> <span id="cart-count">{{ $cartCount }}</span></a>
                    <div class="price" id="cart-total">{{ $cartTotal }} EGP</div>
                    <a class="btn btn-secondary" style="display:inline-block;"  href="{{ route('orders.index') }}"><h4 style="font-size: 16px;">{{ __('message.order') }}</h4></a>
                </div>
            </div>
            
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
@if (Session::has('error'))
    <div class="alert alert-danger text-center">
        {{ Session::get('error') }}
    </div>
@endif