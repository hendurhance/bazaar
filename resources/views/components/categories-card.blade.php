<div class="category-section2 pt-120 pb-120" id="category">
    <div class="container position-relative">
        <div class="row">
            <div class="col-12">
                <div class="swiper category2-slider">
                    <div class="swiper-wrapper">
                        @foreach ( $categories as $category )  
                        <div class="swiper-slide">
                            <div class="eg-card category-card2 wow fadeInDown" data-wow-duration="1.5s"
                                data-wow-delay="0.2s">
                                <img alt="image" src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="category-img">
                                <div class="content">
                                    <img alt="image" src="{{ asset($category->icon) }}" alt="{{ $category->name }}">
                                    <h5><a href="{{ route('live-auction') }}?category={{ $category->slug }}">{{ $category->name }}</a></h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>