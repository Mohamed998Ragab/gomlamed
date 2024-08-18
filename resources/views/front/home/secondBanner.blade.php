<section class="banner_offers py-5">
    <div class="container">
        <div class="row">
            @foreach ($secondBanner as $banner)
            @php
                $translation = $banner->translation($selectedLanguage);
            @endphp
            <div class="col-md-4">
                <div class="icon-box">
                    <i class="{{ $banner->icon }}"></i>
                    <h4>{{ $translation->title }}</h4>
                    <p>{{ $translation->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>