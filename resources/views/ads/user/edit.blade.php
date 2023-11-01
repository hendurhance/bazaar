@extends('partials.app')
@section('title', 'Edit Ad Listing - '.$ad->title)
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Edit Ad Listing', 'hasBack' => true, 'backUrl' => route('user.ads'), 'backTitle' => 'Ads Listing', 'routeItem' => $ad->title])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'ads', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <form class="w-100" action="{{ route('user.ads.edit.handle', $ad->slug) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-section">
                                    <h4>Edit Lisiting Information</h4>
                                </div>
                                <div class="col-md-12">
                                    <x-input-field name="title" type="text" label="Ad Title" placeholder="Enter Ad Title" value="{{ $ad->title }}" />
                                </div>
                            <div class="col-md-12">
                                    <x-textarea-field name="description" label="Ad Description"
                                        placeholder="Enter Description" value="{{ $ad->description }}" :admin="false" />
                                </div>
                                <div class="col-md-12">
                                    <x-input-field name="price" type="number" label="Starting Price"
                                        placeholder="Enter Starting Price" value="{{ $ad->price }}" />
                                </div>
                                <div class="form-section">
                                    <h4>Video</h4>
                                </div>
                                <div class="col-md-12">
                                    <x-input-field name="video_url" type="url" label="Video URL"
                                        placeholder="Enter Video URL" value="{{ $ad->video_url }}" />
                                    <p class="text-muted">Please enter a valid video URL from YouTube or Vimeo, ex.
                                        https://www.youtube.com/watch?v=video_id </p>
                                </div>
                                <div class="form-section">
                                    <h4>Seller Information</h4>
                                </div>
                                <div class="col-md-12">
                                    <x-input-field name="seller_name" type="text" label="Seller Name"
                                        placeholder="Enter Seller Name" :value="$ad->seller_name" />
                                </div>
                                <div class="col-md-12">
                                    <x-input-field name="seller_email" type="email" label="Seller Email"
                                        placeholder="Enter Seller Email" :value="$ad->seller_email" :disabled="true" :readonly="true" />
                                </div>
                                <x-phone-selectable name="seller_mobile" label="Seller Phone"
                                    placeholder="Enter Seller Phone" :value="$ad->seller_mobile" />
                                <div class="col-md-12">
                                    <x-input-field name="seller_address" type="text" label="Seller Address"
                                        placeholder="Enter Seller Address" :value="$ad->seller_address" />
                                </div>
                            </div>
                            <button class="account-btn">Update Listing</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@amplifiedhq/countries-atlas/dist/flags/css/flags.min.css" async defer>
@endpush

@endsection