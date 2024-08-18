<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>{{ __('message.late') }}</span>
                    <h2>{{ __('message.med') }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($blogs as $blog)
                @php
                    $translation = $blog->translation($selectedLanguage);
                @endphp
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset($blog->image) }}">
                        </div>
                        <div class="blog__item__text text-center">
                            <span><img src="{{ asset('front/img/icon/calendar.png') }}" alt=""> {{ $blog->date }}</span>
                            <h5>{{ $translation->title ?? 'No Title Available' }}</h5>
                            <p>{{ $translation->summary ?? 'No Summary Available' }}</p>
                            <a href="{{ url('singleBlog/'. $blog->id) }}">{{ __('message.read_more') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</section>