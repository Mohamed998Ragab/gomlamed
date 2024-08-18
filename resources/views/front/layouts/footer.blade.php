<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div style="padding: 15px !important" class="footer__logo">
                        <img style="width: 100px; height:55px;" src="{{ asset('front/img/Gomla.png') }}" alt="">
                    </div>
                    <p>The customer is at the heart of our unique business model, which includes design.</p>
                    {{-- <a href="#"><img src="{{ asset('front/img/payment.png') }}" alt=""></a> --}}
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Pages</h6>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/shop') }}">Shop</a></li>
                        <li><a href="{{ url('/about') }}">About Us</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Pages</h6>
                    <ul>
                        <li><a href="{{ url('/blog') }}">Blog</a></li>
                        <li><a href="{{ route('login') }}">Sign In</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        <li><a href="{{ route('cart.view') }}">Carts</a></li>
                    </ul>
                </div>
            </div>
            {{-- <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>NewLetter</h6>
                    <div class="footer__newslatter">
                        <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                        <form action="#">
                            <input type="text" placeholder="Your email">
                            <button type="submit"><span class="icon_mail_alt"></span></button>
                        </form>
                    </div>
                </div>
            </div> --}}
        </div>
        {{-- <div class="row">
            <div class="col-lg-12 text-center">
            </div>
        </div> --}}
    </div>
</footer>