@if($type == 'classic')
<div class="col-lg-4 col-md-6 col-sm-10 ">
    <div data-wow-duration="1.5s" data-wow-delay="0.2s" class="eg-card auction-card2 wow fadeInDown">
        <div class="auction-img">
            <img alt="image" src="{{ $ad->media->first()->url }}">
            <div class="auction-timer">
                <div class="countdown" id="timer1">
                    <h5>
                        <span id="days1">05</span>D :<span id="hours1">05</span>H : <span
                            id="minutes1">52</span>M : <span id="seconds1">32</span>S
                    </h5>
                </div>
            </div>
        </div>
        <div class="auction-content">
            <h4><a href="{{ route('auction-details') }}">{{ shorten_title($ad->title)}}</a></h4>
            <div class="author-price-area">
                <div class="author">
                    <img alt="image" src="{{ $ad->user?->avatar  ?? get_random_avatar() }}"><span class="name">By
                        {{ $ad->user->name }}</span>
                        </span>
                </div>
                <p>${{ number_format($ad->price) }}</p>
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
@endif

@if ($type == 'slider')
<div class="swiper-slide">
    <div class="eg-card c-feature-card2 wow fadeInDown" data-wow-duration="1.5s"
        data-wow-delay="0.2s">
        <div class="auction-img">
            <img alt="image" src="{{ $ad->media->first()->url }}">
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
                    <img alt="image" src="{{ $ad->user?->avatar ?? get_random_avatar() }}">
                </div>
                <div class="author-name">
                    <span>by {{ '@'.$ad->user->username }}</span>
                </div>
            </div>
        </div>
        <div class="c-feature-content">
            <div class="c-feature-category">{{ $ad->category->name }}</div>
            <a href="{{ route('auction-details') }}">
                <h4>{{ shorten_title($ad->title)}}</h4>
            </a>
            <p>Bidding Price : <span>${{ number_format($ad->price) }}</span></p>
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
@endif

@if ($type == 'default')
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
@endif