@extends('partials.app')
@section('title', 'View Ad Listing - '.$ad->title)
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'View Ad Listing', 'hasBack' => true, 'backUrl' => route('user.ads'), 'backTitle' => 'Ads Listing', 'routeItem' => $ad->title])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'ads', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="ad-listing-wrapper">
                        <div class="row gy-2 d-flex">
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
                                            <h3>Ad Images</h3>
                                        </div>
                                        <img alt="image" src="{{ $media->url }}" class="img-fluid">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-5">
                                <div class="ad-listing-item">
                                    <span>Title:</span>
                                    <h3>{{ $ad->title }}</h3>
                                </div>
                                <div class="row d-flex">
                                    <div class="ad-listing-item col-4">
                                        <span>Category:</span>
                                        <p>{{ $ad->category->name }}</p>
                                    </div>
                                    <div class="ad-listing-item col-4">
                                        <span>Category:</span>
                                        <p>{{ optional($ad->subcategory)->name }}</p>
                                    </div>
                                    <div class="ad-listing-item col-4">
                                        <span>Video Url:</span>
                                        <p><a href="{{ $ad->video_url }}" class="text-primary" target="_blank">View Video</a></p>
                                    </div>
                                </div>
                                <div class="ad-listing-item">
                                    <span>Starting Price:</span>
                                    <h5>{{ money($ad->price) }}</h5>
                                </div>
                                <div class="ad-listing-item">
                                    <span>Timeframe:</span>
                                    <p>{{ $ad->started_at->format('d M Y h:i A') }} - {{ $ad->expired_at->format('d M Y h:i A') }}</p>
                                </div>
                                <div class="row d-flex">
                                    <div class="ad-listing-item col-6">
                                        <span>Status:</span>
                                        <p class="text-{{ $ad->status->color() }}">{{ $ad->status->label() }}</p>
                                    </div>
                                    <div class="ad-listing-item col-6">
                                        <span>Total Bids:</span>
                                        <p><i class="fa fa-gavel"></i>{{ optional($ad->bids)->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex pt-4">
                            <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-top border-end border-start">
                                <div class="ad-listing-item">
                                    <span>Ad Views:</span>
                                    <p><i class="fa fa-eye"></i> {{ $ad->views }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-top border-end">
                                <div class="ad-listing-item">
                                    <span>Address:</span>
                                    <p><i class="fa fa-map-marker"></i> {{ $ad->seller_address }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-top border-end">
                                <div class="ad-listing-item">
                                    <span>Country:</span>
                                    <p><i class="fa fa-flag"></i> {{ $ad->country->name }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-top border-end">
                                <div class="ad-listing-item">
                                    <span>City / State:</span>
                                    <p><i class="fa fa-map-marker"></i> {{ optional($ad->city)->name .' /'}} {{ optional($ad->state)->name }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-end border-bottom border-start border-top">
                                <div class="ad-listing-item">
                                    <span>Seller Name:</span>
                                    <p><i class="fa fa-user"></i> {{ $ad->seller_name }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-end border-bottom border-top">
                                <div class="ad-listing-item">
                                    <span>Seller Email:</span>
                                    <p><a href="mailto:{{ $ad->seller_email }}" class="text-primary"><i class="fa fa-envelope"></i> {{ mask_chars($ad->seller_email, 3, 4, '@') }}</a></p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-end border-bottom border-top">
                                <div class="ad-listing-item">
                                    <span>Seller Phone:</span>
                                    <p><i class="fa fa-phone"></i> {{ $ad->seller_mobile }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-top border-bottom border-end">
                                <div class="ad-listing-item">
                                    <span>Mark as Urgent:</span>
                                    <p><i class="fa fa-exclamation-triangle"></i> {{ $ad->is_urgent ? 'Yes' : 'No' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="para mt-4">
                            <h3>Description</h3>
                            <p>{{ $ad->description }}</p>
                        </div>
                        {{-- bids --}}
                        <div class="ad-listing-item mt-4">
                            <h3>Bids</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Bid Amount</th>
                                            <th>Bid Date</th>
                                            <th>Current State</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ad->bids->sortByDesc('created_at') as $bid)
                                        <tr class="{{ $bid->is_accepted ? 'table-success' : '' }}">
                                            <td>{{ $bid->user->name }}</td>
                                            <td>{{ money($bid->amount) }}</td>
                                            <td>{{ $bid->created_at->format('d M Y h:i A') }}</td>
                                            <td>{{ is_null($bid->is_accepted) ? 'Pending' : ( $bid->is_accepted ? 'Accepted' : 'Reject' ) }}</td>
                                            <td>
                                                @if($ad->hasAcceptedBid())
                                                    No Action
                                                @else
                                               <form action="{{ route('user.ads.bids.accept', [$ad->slug, $bid->id]) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-primary btn-sm">Accept</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@endsection