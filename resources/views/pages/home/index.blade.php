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
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="0.2s" class="eg-card auction-card2 wow fadeInDown">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc1.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer1">
                                <h5><span id="days1">05</span>D :<span id="hours1">05</span>H : <span
                                        id="minutes1">52</span>M : <span id="seconds1">32</span>S</h5>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Brand New royal Enfield 250 CC For special Sale</a></h4>
                        <div class="author-price-area">
                            <div class="author">
                                <img alt="image" src="assets/images/bg/auction-authr1.png"><span class="name">By
                                    Sara
                                    Alexa</span>
                            </div>
                            <p>$3,45</p>
                        </div>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary2 btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-three-dots-vertical"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="0.4s" class="eg-card auction-card2 wow fadeInDown">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc2.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer2">
                                <h5><span id="days2">05</span>D :<span id="hours2">05</span>H : <span
                                        id="minutes2">52</span>M : <span id="seconds2">32</span>S</h5>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Wedding wow Exclusive Cupple Ring (S2022)</a></h4>
                        <div class="author-price-area">
                            <div class="author">
                                <img alt="image" src="assets/images/bg/auction-authr2.png"><span class="name">By
                                    Sara
                                    Alexa</span>
                            </div>
                            <p>$3,45</p>
                        </div>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary2 btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-three-dots-vertical"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="0.6s" class="eg-card auction-card2 wow fadeInDown">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc3.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer3">
                                <h5><span id="days3">05</span>D :<span id="hours3">05</span>H : <span
                                        id="minutes3">52</span>M : <span id="seconds3">32</span>S</h5>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Brand New Honda CBR 600 RR For Sale (2022)</a></h4>
                        <div class="author-price-area">
                            <div class="author">
                                <img alt="image" src="assets/images/bg/auction-authr3.png"><span class="name">By
                                    Sara
                                    Alexa</span>
                            </div>
                            <p>$3,45</p>
                        </div>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary2 btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-three-dots-vertical"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="0.2s" class="eg-card auction-card2 wow fadeInDown">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc4.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer4">
                                <h5><span id="days4">02</span>D :<span id="hours4">05</span>H : <span
                                        id="minutes4">52</span>M : <span id="seconds4">32</span>S</h5>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Toyota AIGID A Class Hatchback Sale</a>
                        </h4>
                        <div class="author-price-area">
                            <div class="author">
                                <img alt="image" src="assets/images/bg/auction-authr2.png"><span class="name">By
                                    Sara
                                    Alexa</span>
                            </div>
                            <p>$3,45</p>
                        </div>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary2 btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-three-dots-vertical"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="0.4s" class="eg-card auction-card2 wow fadeInDown">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc5.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer5">
                                <h5><span id="days5">03</span>D :<span id="hours5">05</span>H : <span
                                        id="minutes5">52</span>M : <span id="seconds5">32</span>S</h5>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Havit HV-G61 USB Black Double Game With Vibrat</a>
                        </h4>
                        <div class="author-price-area">
                            <div class="author">
                                <img alt="image" src="assets/images/bg/auction-authr3.png"><span class="name">By
                                    Sara
                                    Alexa</span>
                            </div>
                            <p>$3,45</p>
                        </div>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary2 btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-three-dots-vertical"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="0.6s" class="eg-card auction-card2 wow fadeInDown">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc6.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer6">
                                <h5><span id="days6">05</span>D :<span id="hours6">05</span>H : <span
                                        id="minutes6">52</span>M : <span id="seconds6">32</span>S</h5>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">IPhone 11 Pro Max All Variants Available For Sale</a>
                        </h4>
                        <div class="author-price-area">
                            <div class="author">
                                <img alt="image" src="assets/images/bg/auction-authr1.png"><span class="name">By
                                    Sara
                                    Alexa</span>
                            </div>
                            <p>$3,45</p>
                        </div>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary2 btn--sm">Place a Bid</a>
                            <ul class="share-list gap-2">
                                <li><a href="#"><i class="bi bi-heart"></i></a></li>
                                <li><a href="#"><i class="bi bi-three-dots-vertical"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.testimonials')


<div class="upcoming-seciton pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center mb-60">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="section-title2 text-lg-start text-center">
                    <h2>Up Comming Auction</h2>
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
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="eg-card c-feature-card2 wow fadeInDown" data-wow-duration="1.5s"
                            data-wow-delay="0.2s">
                            <div class="auction-img">
                                <img alt="image" src="assets/images/bg/umcoming1.png">
                                <div class="auction-timer2 gap-2" id="timer7">
                                    <div class="countdown-single">
                                        <h5 id="days7">7</h5>
                                        <span>Days</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="hours7">05</h5>
                                        <span>Hours</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="minutes7">56</h5>
                                        <span>Mins</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="seconds7">08</h5>
                                        <span>Secs</span>
                                    </div>
                                </div>
                                <div class="author-area3">
                                    <div class="author-emo">
                                        <img alt="image" src="assets/images/bg/upcoming-author1.png">
                                    </div>
                                    <div class="author-name">
                                        <span>by @robatfox</span>
                                    </div>
                                </div>
                            </div>
                            <div class="c-feature-content">
                                <div class="c-feature-category">Time Zoon</div>
                                <a href="{{ route('auction-details') }}">
                                    <h4>Michael Kors Watch m20L6</h5>
                                </a>
                                <p>Bidding Price : <span>$15.99</span></p>
                                <div class="auction-card-bttm">
                                    <a href="{{ route('auction-details') }}" class="eg-btn btn--primary2 btn--sm">View
                                        Details</a>
                                    <div class="share-area">
                                        <ul class="social-icons d-flex">
                                            <li><a href="https://www.facebook.com/"><i
                                                        class="bx bxl-facebook"></i></a></li>
                                            <li><a href="https://www.twitter.com/"><i
                                                        class="bx bxl-twitter"></i></a></li>
                                            <li><a href="https://www.pinterest.com/"><i
                                                        class="bx bxl-pinterest"></i></a></li>
                                            <li><a href="https://www.instagram.com/"><i
                                                        class="bx bxl-instagram"></i></a></li>
                                        </ul>
                                        <div>
                                            <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="eg-card c-feature-card2 wow fadeInDown" data-wow-duration="1.5s"
                            data-wow-delay="0.4s">
                            <div class="auction-img">
                                <img alt="image" src="assets/images/bg/umcoming2.png">
                                <div class="auction-timer2 gap-2" id="timer8">
                                    <div class="countdown-single">
                                        <h5 id="days8">7</h5>
                                        <span>Days</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="hours8">05</h5>
                                        <span>Hours</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="minutes8">56</h5>
                                        <span>Mins</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="seconds8">08</h5>
                                        <span>Secs</span>
                                    </div>
                                </div>
                                <div class="author-area3">
                                    <div class="author-emo">
                                        <img alt="image" src="assets/images/bg/upcoming-author2.png">
                                    </div>
                                    <div class="author-name">
                                        <span>by @robatfox</span>
                                    </div>
                                </div>
                            </div>
                            <div class="c-feature-content">
                                <div class="c-feature-category">Lit Gaslighte</div>
                                <a href="{{ route('auction-details') }}">
                                    <h4>Toyota AIGID A Clasic Hatchback.</h4>
                                </a>
                                <p>Bidding Price : <span>$15.99</span></p>
                                <div class="auction-card-bttm">
                                    <a href="{{ route('auction-details') }}" class="eg-btn btn--primary2 btn--sm">View
                                        Details</a>
                                    <div class="share-area">
                                        <ul class="social-icons d-flex">
                                            <li><a href="https://www.facebook.com/"><i
                                                        class="bx bxl-facebook"></i></a></li>
                                            <li><a href="https://www.twitter.com/"><i
                                                        class="bx bxl-twitter"></i></a></li>
                                            <li><a href="https://www.pinterest.com/"><i
                                                        class="bx bxl-pinterest"></i></a></li>
                                            <li><a href="https://www.instagram.com/"><i
                                                        class="bx bxl-instagram"></i></a></li>
                                        </ul>
                                        <div>
                                            <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="eg-card c-feature-card2 wow fadeInDown" data-wow-duration="1.5s"
                            data-wow-delay="0.6s">
                            <div class="auction-img">
                                <img alt="image" src="assets/images/bg/umcoming3.png">
                                <div class="auction-timer2 gap-2" id="timer9">
                                    <div class="countdown-single">
                                        <h5 id="days9">7</h5>
                                        <span>Days</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="hours9">05</h5>
                                        <span>Hours</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="minutes9">56</h5>
                                        <span>Mins</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="seconds9">08</h5>
                                        <span>Secs</span>
                                    </div>
                                </div>
                                <div class="author-area3">
                                    <div class="author-emo">
                                        <img alt="image" src="assets/images/bg/upcoming-author3.png">
                                    </div>
                                    <div class="author-name">
                                        <span>by @robatfox</span>
                                    </div>
                                </div>
                            </div>
                            <div class="c-feature-content">
                                <div class="c-feature-category">Motor Bike</div>
                                <a href="{{ route('auction-details') }}">
                                    <h4>North Casual Lifestle Shoes..</h4>
                                </a>
                                <p>Bidding Price : <span>$15.99</span></p>
                                <div class="auction-card-bttm">
                                    <a href="{{ route('auction-details') }}" class="eg-btn btn--primary2 btn--sm">View
                                        Details</a>
                                    <div class="share-area">
                                        <ul class="social-icons d-flex">
                                            <li><a href="https://www.facebook.com/"><i
                                                        class="bx bxl-facebook"></i></a></li>
                                            <li><a href="https://www.twitter.com/"><i
                                                        class="bx bxl-twitter"></i></a></li>
                                            <li><a href="https://www.pinterest.com/"><i
                                                        class="bx bxl-pinterest"></i></a></li>
                                            <li><a href="https://www.instagram.com/"><i
                                                        class="bx bxl-instagram"></i></a></li>
                                        </ul>
                                        <div>
                                            <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="eg-card c-feature-card2 wow fadeInDown" data-wow-duration="1.5s"
                            data-wow-delay=".2s">
                            <div class="auction-img">
                                <img alt="image" src="assets/images/bg/umcoming1.png">
                                <div class="auction-timer2 gap-2" id="timer10">
                                    <div class="countdown-single">
                                        <h5 id="days10">7</h5>
                                        <span>Days</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="hours10">05</h5>
                                        <span>Hours</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="minutes10">56</h5>
                                        <span>Mins</span>
                                    </div>
                                    <div class="countdown-single">
                                        <h5 id="seconds10">08</h5>
                                        <span>Secs</span>
                                    </div>
                                </div>
                                <div class="author-area3">
                                    <div class="author-emo">
                                        <img alt="image" src="assets/images/bg/upcoming-author1.png">
                                    </div>
                                    <div class="author-name">
                                        <span>by @robatfox</span>
                                    </div>
                                </div>
                            </div>
                            <div class="c-feature-content">
                                <div class="c-feature-category">Time Zoon</div>
                                <a href="{{ route('auction-details') }}">
                                    <h4>Michael Kors Watch m20L6</h4>
                                </a>
                                <p>Bidding Price : <span>$15.99</span></p>
                                <div class="auction-card-bttm">
                                    <a href="{{ route('auction-details') }}" class="eg-btn btn--primary2 btn--sm">View
                                        Details</a>
                                    <div class="share-area">
                                        <ul class="social-icons d-flex">
                                            <li><a href="https://www.facebook.com/"><i
                                                        class="bx bxl-facebook"></i></a></li>
                                            <li><a href="https://www.twitter.com/"><i
                                                        class="bx bxl-twitter"></i></a></li>
                                            <li><a href="https://www.pinterest.com/"><i
                                                        class="bx bxl-pinterest"></i></a></li>
                                            <li><a href="https://www.instagram.com/"><i
                                                        class="bx bxl-instagram"></i></a></li>
                                        </ul>
                                        <div>
                                            <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="single-blog-style2 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="0.2s">
                    <div class="blog-img">
                        <a href="#" class="blog-date"><i class="bi bi-calendar-check"></i>Jan 30, 2022</a>
                        <img alt="image" src="assets/images/blog/recent21.png">
                    </div>
                    <div class="blog-content">
                        <h5><a href="{{ route('blog-details') }}">David Droga Still Has Faith in Online Advertising Creative
                            </a></h5>
                        <div class="blog-meta">
                            <div class="author">
                                <img alt="image" src="assets/images/blog/author1.png">
                                <a href="{{ route('blog-details') }}" class="author-name">Johan Martin</a>
                            </div>
                            <div class="comment">
                                <img alt="image" src="assets/images/icons/comment-icon.svg">
                                <a href="#" class="comment">05 Comments</a>
                            </div>
                        </div>
                        <p class="para">Explore on the world's best & largest Bidding market place with our Bidding
                            products.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="single-blog-style2 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="0.4s">
                    <div class="blog-img">
                        <a href="#" class="blog-date"><i class="bi bi-calendar-check"></i>May 30, 2022</a>
                        <img alt="image" src="assets/images/blog/recent22.png">
                    </div>
                    <div class="blog-content">
                        <h5><a href="{{ route('blog-details') }}">Take our friend Johnny No-Job, for example. He’s a
                                specialist in .</a></h5>
                        <div class="blog-meta">
                            <div class="author">
                                <img alt="image" src="assets/images/blog/author1.png">
                                <a href="{{ route('blog-details') }}" class="author-name">Johan Martin</a>
                            </div>
                            <div class="comment">
                                <img alt="image" src="assets/images/icons/comment-icon.svg">
                                <a href="#" class="comment">05 Comments</a>
                            </div>
                        </div>
                        <p class="para">Explore on the world's best & largest Bidding market place with our Bidding
                            products.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="single-blog-style2 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".4s">
                    <div class="blog-img">
                        <a href="#" class="blog-date"><i class="bi bi-calendar-check"></i>May 30, 2022</a>
                        <img alt="image" src="assets/images/blog/recent23.png">
                    </div>
                    <div class="blog-content">
                        <h5><a href="{{ route('blog-details') }}">The second-price sealed-bid auction is similar to the
                                first.</a></h5>
                        <div class="blog-meta">
                            <div class="author">
                                <img alt="image" src="assets/images/blog/author1.png">
                                <a href="{{ route('blog-details') }}" class="author-name">Johan Martin</a>
                            </div>
                            <div class="comment">
                                <img alt="image" src="assets/images/icons/comment-icon.svg">
                                <a href="#" class="comment">05 Comments</a>
                            </div>
                        </div>
                        <p class="para">Explore on the world's best & largest Bidding market place with our Bidding
                            products.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.metrics')
@endsection