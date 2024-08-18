<section class="banner_offers">
    <div class="container">
        @php
            $translation = $firstBanner->translation($selectedLanguage);
        @endphp
        <h1>{{ $translation->title }}</h1>
        <p>{{ $translation->description }}</p>
        {{-- <a class="btn btn-secondary" href="#">Contact Us</a> --}}
    </div>
</section>