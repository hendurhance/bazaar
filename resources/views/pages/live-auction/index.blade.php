@extends('partials.app')
@section('title', 'Live Auction')
@section('description', 'View current live auctions, and bid on items.')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Live Auction'])

<div class="live-auction-section pt-120 pb-120">
    <div class="container">
        <div class="row gy-4 mb-60 d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="0.2s" class="eg-card auction-card1 wow fadeInDown"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc1.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer1">
                                <h4><span id="hours1">04</span>H : <span id="minutes1">22</span>M : <span
                                        id="seconds1">58</span>S</h4>
                            </div>
                        </div>
                        <div class="author-area">
                            <div class="author-emo">
                                <img alt="image" src="assets/images/icons/smile-emo.svg">
                            </div>
                            <div class="author-name">
                                <span>by @robatfox</span>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Brand New royal Enfield 250 CC For Sale</a></h4>
                        <p>Bidding Price : <span>$85.9</span></p>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <ul class="social-icons d-flex">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                </ul>
                                <div>
                                    <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="0.4s" class="eg-card auction-card1 wow fadeInDown"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInDown;">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc2.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer2">
                                <h4><span id="hours2">04</span>H : <span id="minutes2">22</span>M : <span
                                        id="seconds2">58</span>S</h4>
                            </div>
                        </div>
                        <div class="author-area">
                            <div class="author-emo">
                                <img alt="image" src="assets/images/icons/smile-emo.svg">
                            </div>
                            <div class="author-name">
                                <span>by @robatfox</span>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Wedding Special Exclusive Cupple Ring (S2022)</a></h4>
                        <p>Bidding Price : <span>$85.9</span></p>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <ul class="social-icons d-flex">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                </ul>
                                <div>
                                    <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="0.6s" class="eg-card auction-card1 wow fadeInDown"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.6s; animation-name: fadeInDown;">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc3.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer3">
                                <h4><span id="hours3">04</span>H : <span id="minutes3">22</span>M : <span
                                        id="seconds3">58</span>S</h4>
                            </div>
                        </div>
                        <div class="author-area">
                            <div class="author-emo">
                                <img alt="image" src="assets/images/icons/smile-emo.svg">
                            </div>
                            <div class="author-name">
                                <span>by @robatfox</span>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Brand New Honda CBR 600 RR For Sale (2022)</a></h4>
                        <p>Bidding Price : <span>$85.9</span></p>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <ul class="social-icons d-flex">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                </ul>
                                <div>
                                    <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="0.8s" class="eg-card auction-card1 wow fadeInDown"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.8s; animation-name: fadeInDown;">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc4.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer4">
                                <h4><span id="hours4">04</span>H : <span id="minutes4">22</span>M : <span
                                        id="seconds4">58</span>S</h4>
                            </div>
                        </div>
                        <div class="author-area">
                            <div class="author-emo">
                                <img alt="image" src="assets/images/icons/smile-emo.svg">
                            </div>
                            <div class="author-name">
                                <span>by @robatfox</span>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Toyota AIGID A Class Hatchback Sale (2017 - 2021)</a>
                        </h4>
                        <p>Bidding Price : <span>$85.9</span></p>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <ul class="social-icons d-flex">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                </ul>
                                <div>
                                    <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="1s" class="eg-card auction-card1 wow fadeInDown"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 1s; animation-name: fadeInDown;">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc5.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer5">
                                <h4><span id="hours5">04</span>H : <span id="minutes5">22</span>M : <span
                                        id="seconds5">58</span>S</h4>
                            </div>
                        </div>
                        <div class="author-area">
                            <div class="author-emo">
                                <img alt="image" src="assets/images/icons/smile-emo.svg">
                            </div>
                            <div class="author-name">
                                <span>by @robatfox</span>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Havit HV-G61 USB Black Double Game Pad With Vibrat</a>
                        </h4>
                        <p>Bidding Price : <span>$85.9</span></p>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <ul class="social-icons d-flex">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                </ul>
                                <div>
                                    <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay=".8s" class="eg-card auction-card1 wow fadeInDown"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.8s; animation-name: fadeInDown;">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc6.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer6">
                                <h4><span id="hours6">04</span>H : <span id="minutes6">22</span>M : <span
                                        id="seconds6">58</span>S</h4>
                            </div>
                        </div>
                        <div class="author-area">
                            <div class="author-emo">
                                <img alt="image" src="assets/images/icons/smile-emo.svg">
                            </div>
                            <div class="author-name">
                                <span>by @robatfox</span>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">IPhone 11 Pro Max All Variants Available For Sale</a>
                        </h4>
                        <p>Bidding Price : <span>$85.9</span></p>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <ul class="social-icons d-flex">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                </ul>
                                <div>
                                    <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="1.4s" class="eg-card auction-card1 wow fadeInDown"
                    style="visibility: hidden; animation-duration: 1.5s; animation-delay: 1.4s; animation-name: none;">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc7.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer7">
                                <h4><span id="hours7">04</span>H : <span id="minutes7">22</span>M : <span
                                        id="seconds7">58</span>S</h4>
                            </div>
                        </div>
                        <div class="author-area">
                            <div class="author-emo">
                                <img alt="image" src="assets/images/icons/smile-emo.svg">
                            </div>
                            <div class="author-name">
                                <span>by @robatfox</span>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Blue ray filter All Variants Available For Sale</a>
                        </h4>
                        <p>Bidding Price : <span>$85.9</span></p>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <ul class="social-icons d-flex">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                </ul>
                                <div>
                                    <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="1.6s" class="eg-card auction-card1 wow fadeInDown"
                    style="visibility: hidden; animation-duration: 1.5s; animation-delay: 1.6s; animation-name: none;">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc8.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer8">
                                <h4><span id="hours8">04</span>H : <span id="minutes8">22</span>M : <span
                                        id="seconds8">58</span>S</h4>
                            </div>
                        </div>
                        <div class="author-area">
                            <div class="author-emo">
                                <img alt="image" src="assets/images/icons/smile-emo.svg">
                            </div>
                            <div class="author-name">
                                <span>by @robatfox</span>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Pure leather All Variants Available For Sale</a>
                        </h4>
                        <p>Bidding Price : <span>$85.9</span></p>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <ul class="social-icons d-flex">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                </ul>
                                <div>
                                    <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 ">
                <div data-wow-duration="1.5s" data-wow-delay="1.2s" class="eg-card auction-card1 wow fadeInDown"
                    style="visibility: hidden; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: none;">
                    <div class="auction-img">
                        <img alt="image" src="assets/images/bg/live-auc9.png">
                        <div class="auction-timer">
                            <div class="countdown" id="timer9">
                                <h4><span id="hours9">04</span>H : <span id="minutes9">22</span>M : <span
                                        id="seconds9">58</span>S</h4>
                            </div>
                        </div>
                        <div class="author-area">
                            <div class="author-emo">
                                <img alt="image" src="assets/images/icons/smile-emo.svg">
                            </div>
                            <div class="author-name">
                                <span>by @robatfox</span>
                            </div>
                        </div>
                    </div>
                    <div class="auction-content">
                        <h4><a href="{{ route('auction-details') }}">Water resist All Variants Available For Sale</a>
                        </h4>
                        <p>Bidding Price : <span>$85.9</span></p>
                        <div class="auction-card-bttm">
                            <a href="{{ route('auction-details') }}" class="eg-btn btn--primary btn--sm">Place a Bid</a>
                            <div class="share-area">
                                <ul class="social-icons d-flex">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
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
        <div class="row">
            <nav class="pagination-wrap">
                <ul class="pagination d-flex justify-content-center gap-md-3 gap-2">
                    <li class="page-item">
                        <a class="page-link" href="#" tabindex="-1">Prev</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">01</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">02</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@include('layouts.metrics')

@endsection