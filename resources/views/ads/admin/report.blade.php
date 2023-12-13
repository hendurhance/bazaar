@extends('partials.admin')
@section('title', 'Admin Reported Ads Details - ' . $reportAd->ad->title)
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'ads.reported'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
    <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Ad Report Details', 'hasBack' => true, 'backTitle' => 'Ads Listing', 'backUrl' => route('admin.ads.reported')])
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
                                                        @foreach ($reportAd->ad->media as $media)
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
                                                            @foreach ($reportAd->ad->media as $media)
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
                                        <h3 class="mb-3 fw-semibold">{{ $reportAd->reason }}</h3>
                                        <p class="text-muted mb-4"><i class="fa-light fa-user"></i><span class="fw-bold me-2"> Posted By:</span> <a class="text-primary" href="mailto:{{$reportAd->email}}"> {{$reportAd->email}} </a> </p>
                                        <h4 class="mt-4"><b> Reason Desciption</b></h4>
                                        <p>{{$reportAd->description}}</p>
                                        <div class=" mt-4 mb-5"><span class="fw-bold me-2">View Ad Details :</span><a href="{{route('admin.ads.show', $reportAd->ad->slug)}}" class="text-primary">{{ $reportAd->ad->title}} </a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection