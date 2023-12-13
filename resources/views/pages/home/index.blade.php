@extends('partials.app')
@section('title', 'Home')
@section('description', 'The right marketplace to auction your items.')
@section('content')
<div class="hero-area hero-style-two">
    <div class="scroll-text">
        <h6><a href="#category">Scroll Down</a></h6>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-start align-items-end">
            <div class="col-xl-7 col-lg-7">
                <div class="banner2-content">
                    <h1 class="wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="1s">
                        Join Our Next Auction To Get Your Dream Product
                    </h1>
                    <p class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s">
                        Are you ready to embark on a thrilling journey of buying and selling like never before? Look no further than Bazaar - your one-stop destination for exhilarating online auctions! 
                    </p>
                    <a href="{{ route('live-auction') }}" class="eg-btn btn--primary2 btn--lg wow fadeInUp"
                        data-wow-duration="2s" data-wow-delay="0.8s">Start Bidding</a>
                </div>
            </div>
        </div>
    </div>
</div>


<x-categories-card />


<div class="live-auction pb-120">
    <div class="container position-relative">
        <img alt="image" src="assets/images/bg/dotted2.png" class="dotted3">
        <div class="row d-flex justify-content-center align-items-center mb-60 g-4">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="section-title2 text-lg-start text-center">
                    <h2>Live Auction</h2>
                    <p class="mb-0">Explore on the world's best & largest Bidding marketplace with our beautiful
                        Bidding
                        products. We want to be a part of your smile, success and future growth.</p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-4 col-xl-6 text-lg-end text-center">
                <a href="{{ route('live-auction') }}" class="eg-btn btn--primary2 btn--md">View All</a>
            </div>
        </div>
        <div class="row gy-4 d-flex justify-content-center">
            @forelse ( $ads as $ad )
            <x-ad-item-card :ad="$ad" type="classic" />
            @empty
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/icons/man.svg') }}" alt="empty" class="w-25">
                    </div>
                    <x-alert type="warning">
                        <p class="text-center mb-0"><strong>Sorry!</strong> No active ads available at this time. Try again later, or check out our upcoming auctions.</p>
                    </x-alert>
                </div>
            @endforelse
        </div>
    </div>
</div>


@include('layouts.testimonials')


<div class="upcoming-seciton pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center mb-60">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="section-title2 text-lg-start text-center">
                    <h2>Upcoming Auction</h2>
                    <p class="mb-0">Explore on the world's best & largest Bidding marketplace with our beautiful
                        Bidding
                        products. We want to be a part of your smile, success and future growth.</p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-4 d-lg-block d-none">
                <div class="slider-bottom d-flex justify-content-end align-items-center">
                    <div class="slider-arrows coming-arrow d-flex gap-3">
                        <div class="coming-prev2 swiper-prev-arrow" tabindex="0" role="button"
                            aria-label="Previous slide"><i class="bi bi-arrow-left"></i></div>
                        <div class="coming-next2 swiper-next-arrow" tabindex="0" role="button"
                            aria-label="Next slide"> <i class="bi bi-arrow-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="swiper upcoming-slider2">
                <div class="swiper-wrapper" @if (count($upcomingAds) < 1) style="display: block !important;" @endif>
                    @forelse ( $upcomingAds as $ad )
                    <x-ad-item-card :ad="$ad" type="slider" />
                    @empty
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/icons/man.svg') }}" alt="empty" class="w-25">
                        </div>
                        <x-alert type="warning">
                            <p class="text-center mb-0"><strong>Sorry!</strong> No upcoming ads available at this time. Try again later, or check out our active auctions.</p>
                        </x-alert>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>


<div class="sponsor-section style-2">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="section-title1">
                    <h2>Trusted By 500+ Businesses.</h2>
                    <p class="mb-0">Explore on the world's best & largest Bidding marketplace with our beautiful
                        Bidding
                        products. We want to be a part of your smile, success and future growth.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="slick-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.3s">
                <div id="slick1">
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor1.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor2.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor3.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor4.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor5.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor6.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor7.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor8.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor9.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor1.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor3.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor5.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor8.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor6.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor7.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor8.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor1.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor2.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor9.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor8.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor9.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor1.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor3.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor5.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor8.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor6.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor7.png"></div>
                    <div class="slide-item"><img alt="image" src="assets/images/bg/sponsor8.png"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="recent-news-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="section-title1">
                    <h2>Our Recent News</h2>
                    <p class="mb-0">Explore on the world's best & largest Bidding marketplace with our beautiful
                        Bidding
                        products. We want to be a part of your smile, success and future growth.</p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center g-4">
            @forelse ( $posts as $post )
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="single-blog-style2 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="0.2s">
                    <div class="blog-img">
                        <a href="#" class="blog-date"><i class="bi bi-calendar-check"></i>{{ $post->created_at->format('M d, Y') }}</a>
                        <img alt="image" src="{{$post->featured_image_url}}">
                    </div>
                    <div class="blog-content">
                        <h5><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }} </a></h5>
                        <div class="blog-meta">
                            <div class="author">
                                <img alt="image" src="assets/images/blog/author1.png">
                                <a href="{{ route('blog.show', $post->slug) }}" class="author-name">Johan Martin</a>
                            </div>
                            <div class="comment">
                                <img alt="image" src="assets/images/icons/comment-icon.svg">
                                <a href="#" class="comment">05 Comments</a>
                            </div>
                        </div>
                        <p class="para">{{ shorten_chars($post->content, 100, true) }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/images/icons/man.svg') }}" alt="empty" class="w-25">
                </div>
                <x-alert type="warning">
                    <p class="text-center mb-0"><strong>Sorry!</strong> No blog posts available at this time. Try again later.</p>
                </x-alert>
            </div>
            @endforelse

        </div>
    </div>
</div>

<x-metric-card class="pt-120" />
@push('scripts')
<script src="/assets/js/countdown.js"></script>
@endpush
@endsection