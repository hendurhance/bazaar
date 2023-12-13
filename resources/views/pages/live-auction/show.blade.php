@extends('partials.app')
@section('title', 'Auction Detail')
@section('description', 'Auction detail page')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Auction Detail'])

<div class="auction-details-section pt-120">
    <div class="container">
        <div class="row g-4 mb-50">
            <div
                class="col-xl-6 col-lg-7 d-flex flex-row align-items-start justify-content-lg-start justify-content-center flex-md-nowrap flex-wrap gap-4">
                <ul class="nav small-image-list d-flex flex-md-column flex-row justify-content-center gap-4  wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay=".4s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInDown;">
                    @foreach ($ad->media as $media)
                    <li class="nav-item">
                        <div id="details-img{{ $loop->index + 1 }}" data-bs-toggle="pill" data-bs-target="#gallery-img{{ $loop->index + 1 }}"
                            aria-controls="gallery-img{{ $loop->index + 1 }}" class="">
                            <img alt="image" src="{{ $media->url }}" class="img-fluid">
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content mb-4 d-flex justify-content-lg-start justify-content-center  wow fadeInUp"
                    data-wow-duration="1.5s" data-wow-delay=".4s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInUp;">
                    @foreach ($ad->media as $media)
                    <div class="tab-pane big-image fade {{ $loop->index == 0 ? 'active show' : '' }}" id="gallery-img{{ $loop->index + 1 }}">
                        <div class="auction-gallery-timer d-flex align-items-center justify-content-center">
                            <h3 class="countdown-classic">{{ $ad->expired_at }}</h3>
                        </div>
                        <img alt="image" src="{{ $media->url }}" class="img-fluid">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-6 col-lg-5">
                <div class="product-details-right  wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    <h3>{{ $ad->title }}</h3>
                    <p class="para">{{ shorten_chars($ad->description, 150, true) }}</p>
                    <h4>Bidding Price: <span>{{ money($ad->price) }}</span></h4>
                    <div class="row d-flex mt-4">
                        <div class="ad-listing-item col-6">
                            <span>Seller Name:</span>
                            <p class="fw-bold">{{ $ad->seller_name }}</p>
                        </div>
                        <div class="ad-listing-item col-6">
                            <span>Seller Email:</span>
                            <p>{{ $ad->seller_email ?? 'Not Available' }}</p>
                        </div>
                        <div class="ad-listing-item col-6">
                            <span>Seller Phone:</span>
                            <p>{{ $ad->seller_mobile ?? 'Not Available' }}</p>
                        </div>
                        <div class="ad-listing-item col-6">
                            <span>Seller Address:</span>
                            <address>{{ $ad->seller_address ?? 'Not Available' }}</address>
                        </div>
                    </div>
                    {{-- div for report ad button --}}
                    <div class="row d-flex mb-4">
                        <div class="ad-listing-item col-12">
                            <span> If you find this ad inappropriate, please report it to us.</span>
                            <a href="{{ route('auction-details.report', $ad->slug) }}" class="text-danger fw-bold"><i class="bi bi-exclamation-circle-fill"></i> Report Ad</a>
                        </div>
                    </div>
                    @if($ad->active())
                    <div class="bid-form mt-0">
                        <div class="form-title">
                            <h5>Bid Now</h5>
                            <p>Bid Amount : Minimum Bid {{ money($ad->highestBid->amount ?? $ad->price + 1) }}</p>
                        </div>
                        <form action="{{ route('bid.handle', $ad->slug) }}" method="POST">
                            @csrf
                            @guest
                                <x-alert type="warning" icon="bi bi-exclamation-circle-fill">
                                    <p class="mb-0">You are currently not logged in. If you have an account, please <strong><a href="{{ route('user.login') }}">login</a> </strong> to place a bid to have a chance of winning this auction.</p>
                                </x-alert>
                            @endguest
                            <div class="form-inner gap-2">
                                <input type="number" placeholder="$00.00" @guest disabled @endguest name="amount" required @class(['error' => $errors->has('amount')]) min="{{ $ad->highestBid->amount ?? $ad->price + 1 }}" value="{{ old('amount') }}">
                                <button @class(['eg-btn btn--primary btn--sm' => 'auth', 'eg-btn btn--primary btn--sm disabled' => '!auth']) @guest disabled @else type="submit" @endguest>Place a Bid</button>
                            </div>
                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                        </form>
                    </div>
                    @else
                    <x-alert type="dark" icon="bi bi-exclamation-circle-fill">
                        @if($ad->expired())
                        <p class="text-dark mb-0">
                            This ad listing has expired. You can no longer place a bid on this auction. Try checking out other auctions at <strong><a class="text-gray" href="{{ route('live-auction') }}">live auctions</a></strong> page.
                        </p>
                        @elseif($ad->upcoming())
                        <p class="text-dark mb-0">
                            This ad listing is yet to start. You can not place a bid on this auction yet. Try checking out other auctions at <strong><a href="{{ route('live-auction') }}">live auctions</a></strong> page.
                        </p>
                        @else
                        <p class="text-dark mb-0">
                            This ad listing has been closed. You can no longer place a bid on this auction. Try checking out other auctions at <strong><a href="{{ route('live-auction') }}">live auctions</a></strong> page.
                        </p>
                        @endif
                    </x-alert>
                    @endif
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center g-4">
            <div class="col-lg-8">
                <ul class="nav nav-pills d-flex flex-row justify-content-start gap-sm-4 gap-3 mb-45 wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay=".2s" id="pills-tab" role="tablist"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active details-tab-btn" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link details-tab-btn" id="pills-bid-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-bid" type="button" role="tab" aria-controls="pills-bid"
                            aria-selected="false">Biding History</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link details-tab-btn" id="pills-contact-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                            aria-selected="false">Other Auction</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                        id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="describe-content">
                            {!! $ad->description !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-bid" role="tabpanel" aria-labelledby="pills-bid-tab">
                        <div class="bid-list-area">
                            <ul class="bid-list">
                                @forelse ($ad->bids->sortByDesc('created_at') as $bid)
                                <li>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-7">
                                            <div class="bidder-area">
                                                <div class="bidder-img">
                                                    <img alt="image" src="{{ $bid->user->avatar }}" class="avatar-img">
                                                </div>
                                                <div class="bidder-content">
                                                    <a href="#">
                                                        <h6>{{ $bid->user->name }}</h6>
                                                    </a>
                                                    <p> {{ money($bid->amount) }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end">
                                            <div class="bid-time">
                                                <p>{{ $bid->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <div class="alert alert-warning" role="alert">
                                    No bid has been placed on this auction yet.
                                </div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="row d-flex justify-content-center g-4">
                            @foreach ($ad->relatedAds()->get() as $ad)
                                <x-ad-item-card :ad="$ad" type="small" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <div class="sidebar-banner wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 1s; animation-name: fadeInUp;">
                        <div class="banner-content">
                            <span>CARS</span>
                            <h3>Toyota AIGID A Clasis Cars Sale</h3>
                            <a href="{{ route('auction-details', $ad->slug) }}" class="eg-btn btn--primary card--btn">Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card :class="'pt-120'" />
@push('scripts')
<script src="/assets/js/countdown.js"></script>
@endpush
@endsection