@extends('partials.admin')
@section('title', 'Admin Ads Details - ' . $ad->title)
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'ads.all'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Ads Details', 'hasBack' => true, 'backTitle' => 'Ads Listing', 'backUrl' => route('admin.ads.index')])
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row row-sm">
                                <div class="col-xl-5 col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="product-carousel">
                                                <div id="Slider" class="carousel slide border" data-bs-ride="false">
                                                    <div class="carousel-inner">
                                                        @foreach ($ad->media as $media)
                                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}"> 
                                                            <img src="{{ $media->url }}" alt="img" class="img-fluid mx-auto d-block">
                                                            <div class="text-center mb-5 mt-5 btn-list">
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix carousel-slider">
                                                <div id="thumbcarousel" class="carousel slide" data-bs-interval="t">
                                                    <div class="carousel-inner">
                                                        <ul class="carousel-item active">
                                                            @foreach ($ad->media as $media)
                                                            <li data-bs-target="#Slider" data-bs-slide-to="{{ $loop->index }}" class="thumb {{ $loop->first ? 'active' : '' }} m-2"><img src="{{ $media->url }}" alt="img"></li> 
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                                    <div class="mt-2 mb-4">
                                        <h3 class="mb-3 fw-semibold">{{ $ad->title }}</h3>
                                        <p class="text-muted mb-4"><i class="fa-light fa-user"></i><span class="fw-bold me-2"> Posted By:</span> <a class="text-primary" href="{{$ad->user->id}}"> {{$ad->user->name}} </a>  |  <i class="fa-regular fa-eye"></i>  Views: ( {{ $ad->views }} Customers Viewed )</p>
                                        <h4 class="mt-4"><b> Description</b></h4>
                                        <p>{{shorten_chars($ad->description, 250, true)}}</p>
                                        <h3 class="mb-4"><span class="me-2 fw-bold fs-25 d-inline-flex"> {{ money($ad->price) }} </span></h3>
                                        <div class=" mt-4 mb-5"><span class="fw-bold me-2">Category :</span><span class="fw-bold text-primary">{{ $ad->category->name ?? 'N/A' }}</span> | <span class="fw-bold me-2 ms-2">Sub Category :</span><span class="fw-bold text-primary">{{ $ad->subCategory->name ?? 'N/A' }}</span></div>
                                        <div class=" mt-4 mb-5"><span class="fw-bold me-2">Timeframe :</span><span class="fw-bold text-dark">{{ $ad->started_at->format('d M, Y') }} - {{ $ad->expired_at->format('d M, Y') }}</span></div>
                                        <div class=" mt-4 mb-5">
                                            <span class="fw-bold me-2">Status :</span><span class="fw-bold text-{{ $ad->status->color() }}">{{ $ad->status->label() }}</span> | 
                                            <span class="fw-bold me-2">Availability :</span><span class="fw-bold text-dark">{{ $ad->hasAcceptedBid() ? 'Sold' : 'Available' }}</span> |
                                            <span class="fw-bold me-2">Reports :</span><a href="{{ route('admin.ads.reported', ['search' => $ad->id]) }}" class="fw-bold text-primary">See Ad Reports</a>
                                        </div>
                                        <div class="colors d-flex me-3 mt-4 mb-5">
                                            <span class="fw-bold me-2">Bids:</span><span class="fw-bold text-dark">{{ $ad->bids->count() }} Bids</span>
                                        </div>
                                        <hr>
                                        <div class="btn-list d-flex mt-4">
                                            <a href="{{ route('admin.ads.edit', $ad->slug) }}" class="btn ripple btn-primary me-2"><i class="fa-regular fa-edit"> </i> Edit Ad</a>
                                            <form action="{{ route('admin.ads.destroy', $ad->slug) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn ripple btn-danger" type="submit"><i class="fa-regular fa-trash"> </i> Delete Ad</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="card productdesc">
                        <div class="card-body">
                            <div class="panel panel-primary">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs" role="tablist">
                                            <li><a href="#tab5" class="active" data-bs-toggle="tab" aria-selected="true" role="tab">Details</a></li>
                                            <li><a href="#tab6" data-bs-toggle="tab" aria-selected="false" role="tab" class="" tabindex="-1">Bids</a></li>
                                            <li><a href="#tab7" data-bs-toggle="tab" aria-selected="false" role="tab" class="" tabindex="-1">Others</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="tab5" role="tabpanel">
                                            <h4 class="mb-5 mt-3 fw-bold">Description :</h4>
                                            <p class="mb-3 fs-15">
                                                {!! $ad->description !!}
                                            </p>
                                            <h4 class="mb-5 mt-3 fw-bold">Seller Information :</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody><tr>
                                                        <td class="fw-bold">Seller Name</td>
                                                        <td>{{ $ad->seller_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">Seller Address</td>
                                                        <td><address>{{ $ad->seller_address }}</address></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">Seller Phone</td>
                                                        <td><a href="tel:{{ $ad->seller_mobile }}">{{ $ad->seller_mobile }}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">Seller Email</td>
                                                        <td> <a href="mailto:{{ $ad->seller_email }}">{{ $ad->seller_email }}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">Seller City/State</td>
                                                        <td> {{ optional($ad->city)->name .' /'}} {{ optional($ad->state)->name }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">Seller Country</td>
                                                        <td>{{ optional($ad->country)->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">Wiinning Bid</td>
                                                        <td>
                                                            <p class="text-muted float-start me-3">
                                                                <span class="text-success fw-semibold">
                                                                    @if ($ad->winningBid()->first())
                                                                        {{ money($ad->winningBid()->first()->amount) }}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </div>
                                        </div>
                                        <div class="tab-pane pt-5" id="tab6" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Bid Amount</th>
                                                            <th>Bid Date</th>
                                                            <th>Current State</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($ad->bids as $bid)
                                                            <tr>
                                                                <td>{{ $bid->user->name }}</td>
                                                                <td>{{ money($bid->amount) }}</td>
                                                                <td>{{ $bid->created_at->format('d M, Y') }}</td>
                                                                <td @class(['text-success' => $bid->is_accepted, 'text-danger' => !$bid->is_accepted])
                                                                >{{ is_null($bid->is_accepted) ? 'Pending' : ( $bid->is_accepted ? 'Accepted' : 'Reject' ) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab7" role="tabpanel">
                                            <ul class="p-5">
                                                <li><i class="fa-light fa-check me-3 text-success mb-5"></i>Video URL : <a href="{{ $ad->video_url }}" target="_blank">{{ $ad->video_url }}</a></li>
                                                <li><i class="fa-light fa-check me-3 text-success mb-5"></i>Mark as Urgent: <span class="badge bg-{{ $ad->mark_as_urgent ? 'success' : 'danger' }}">{{ $ad->mark_as_urgent ? 'Yes' : 'No' }}</span></li>
                                                <li><i class="fa-light fa-check me-3 text-success mb-5"></i>Is Negotiable: <span class="badge bg-{{ $ad->is_negotiable ? 'success' : 'danger' }}">{{ $ad->is_negotiable ? 'Yes' : 'No' }}</span></li>
                                                <li><i class="fa-light fa-check me-3 text-success mb-5"></i>Ad Type: <span class="text-dark">{{ $ad->ad_type ?? 'N/A' }}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="p-3 mb-5">Related Ad</h3>
                @foreach ($ad->relatedAds()->get()  as $relatedAd)
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="product-grid6">
                            <div class="product-image6 p-5">
                                <a href="{{route('admin.ads.show', $relatedAd->slug)}}" class="bg-light">
                                    <img class="img-fluid br-7 w-100" src="{{$relatedAd->media->first()->url}}" alt="img">
                                </a>
                            </div>
                            <div class="card-body pt-0">
                                <div class="product-content text-center">
                                    <h1 class="title fw-bold fs-20"><a href="{{route('admin.ads.show', $relatedAd->slug)}}">{{$relatedAd->title}}</a></h1>
                                    <div class="price">{{money($relatedAd->price)}}</div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{route('admin.ads.show', $relatedAd->slug)}}" class="btn btn-outline-primary mb-1"><i class="fe fe-heart mx-2"></i>View Ad</a>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection