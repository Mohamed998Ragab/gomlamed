<style>
    /* RTL (Right-to-Left) styles */
.rtl {
    direction: rtl;
    text-align: right;
}
</style>
<section class="hero">
    @foreach ($sliders as $slider)
    @php
        $translation = $slider->translation($selectedLanguage);
        $direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
    @endphp
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="{{ asset($slider->image) }}">
            <div class="container">
                <div class="row {{ $direction }}">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text ">
                            <h6>{{ $translation->title }}</h6>
                            <h2>{{ $translation->second_title }}</h2>
                            <p>{{ $translation->description }}</p>
                            <a href="#" class="primary-btn">{{ __('message.shop_now') }}<span class="shop"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>