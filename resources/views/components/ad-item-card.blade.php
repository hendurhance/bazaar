@if($type == 'classic')
<div class="col-lg-4 col-md-6 col-sm-10 ">
    <div data-wow-duration="1.5s" data-wow-delay="0.2s" class="eg-card auction-card2 wow fadeInDown">
        <div class="auction-img">
            <img alt="image" src="{{ $ad->media->first()->url }}">
            <div class="auction-timer">
                <div class="countdown">
                    <h5 class="countdown-classic" >
                        {{ $ad->expired_at }}
                    </h5>
                </div>
            </div>
        </div>
        <div class="auction-content">
            <h4><a href="{{ route('auction-details', $ad->slug) }}">{{ shorten_chars($ad->title)}}</a></h4>
            <div class="author-price-area">
                <div class="author">
                    <img alt="image" src="{{ $ad->user?->avatar  ?? get_random_avatar() }}"><span class="name">By
                        {{ $ad->user->name }}</span>
                        </span>
                </div>
                <p>{{ money($ad->price) }}</p>
            </div>
            <div class="auction-card-bttm">
                <a href="{{ route('auction-details', $ad->slug) }}" class="eg-btn btn--primary2 btn--sm">Place a Bid</a>
                <div class="share-area">
                    <a href="#" class="share-btn"><i class="bx bxs-share-alt"></i></a>
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
            <div class="auction-timer2 gap-2 countdown-slider">
                {{ $ad->expired_at }}
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
            <a href="{{ route('auction-details', $ad->slug) }}">
                <h4>{{ shorten_chars($ad->title)}}</h4>
            </a>
            <p>Bidding Price : <span>{{ money($ad->price) }}</span></p>
            <div class="auction-card-bttm">
                <a href="{{ route('auction-details', $ad->slug) }}" class="eg-btn btn--primary2 btn--sm">View
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
            <img alt="image" src="{{ $ad->media->first()->url }}">
            <div class="auction-timer">
                <div class="countdown">
                    <h4 class="countdown-default">
                        {{ $ad->expired_at }}
                    </h4>
                </div>
            </div>
            <div class="author-area">
                <div class="author-emo">
                    <img alt="image" src="{{ $ad->user?->avatar ?? get_random_avatar() }}">
                </div>
                <div class="author-name">
                    <span>by {{ '@'.$ad->user->username }}</span>
                </div>
            </div>
        </div>
        <div class="auction-content">
            <div class="c-feature-category">{{ $ad->category->name }}</div>
            <h4><a href="{{ route('auction-details', $ad->slug) }}">{{ shorten_chars($ad->title)}}</a></h4>
            <p>Bidding Price : <span>{{ money($ad->price) }}</span></p>
            <div class="auction-card-bttm">
                <a href="{{ route('auction-details', $ad->slug) }}" class="eg-btn btn--primary btn--sm">Place a Bid</a>
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

@if($type == 'small')
<div class="col-lg-6 col-md-4 col-sm-10">
    <div class="eg-card auction-card1">
        <div class="auction-img">
            <img alt="image" src="{{ $ad->media->first()->url }}">
            <div class="auction-timer">
                <div class="countdown" id="timer1">
                    <h4 class="countdown-default small-countdown-text">{{ $ad->expired_at }}</h4>
                </div>
            </div>
            <div class="author-area">
                <div class="author-emo">
                    <img alt="image" src="{{ $ad->user?->avatar ?? get_random_avatar() }}">
                </div>
                <div class="author-name">
                    <span>by {{ '@'.$ad->user->username }}</span>
                </div>
            </div>
        </div>
        <div class="auction-content">
            <h4><a href="{{ route('auction-details', $ad->slug) }}">{{ shorten_chars($ad->title)}}</a></h4>
            <p>Bidding Price : <span>{{ money($ad->price) }}</span></p>
            <div class="auction-card-bttm">
                <a href="{{ route('auction-details', $ad->slug) }}" class="eg-btn btn--primary btn--sm">Place a
                    Bid</a>
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