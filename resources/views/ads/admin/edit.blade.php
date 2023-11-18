@extends('partials.admin')
@section('title', 'Admin Ads Edit - ' . $ad->title)
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'ads.all'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Ads Edit', 'hasBack' => true, 'backTitle' => 'Ads Listing', 'backUrl' => route('admin.ads.index')])
            <div class="row">
                <div class="col-lg-12">
                    <form class="card" method="POST" action="{{ route('admin.ads.update', $ad->slug) }}">
                        @method('PUT')
                        @csrf
                        <div class="card-header">
                            <div class="card-title">Edit Ad Listing</div>
                        </div>
                        <div class="card-body">
                            <x-input-item-field name="title" type="text" label="Ad Title" placeholder="Enter Ad Title" :value="$ad->title" />
                            <x-input-item-field name="price" type="number" label="Starting Price" placeholder="Enter Starting Price" value="{{ $ad->price }}" />
                            <x-input-item-field name="video_url" type="url" label="Video URL" placeholder="Enter Video URL" value="{{ $ad->video_url }}" />
                            <x-category-selectable :admin="true" :selected-category="$ad->category->slug"/>
                            <!-- Row -->
                            <x-text-area-field name="description" label="Ad Description" placeholder="Enter Description" :value="$ad->description" :admin="true" />
                            <!--End Row-->
                            <x-input-item-field name="start_date" type="datetime-local" label="Start Date" placeholder="Enter Start Date" :value="$ad->started_at" />
                            <x-input-item-field name="end_date" type="datetime-local" label="Start Date" placeholder="Enter Start Date" :value="$ad->expired_at" />
                            <!--Row-->
                            <div class="row">
                                <label class="col-md-3 form-label mb-4">Product Upload :</label>
                                <div class="col-md-9">
                                    <input id="demo" type="file" name="images[]" accept=".jpg, .png, image/jpeg, image/png" multiple>
                                </div>
                            </div>
                            <br>
                            <x-input-item-field name="seller_name" type="text" label="Seller Name" placeholder="Enter Seller's Name" :value="$ad->seller_name"  />
                            <x-input-item-field name="seller_email" type="email" label="Seller Email" placeholder="Enter Seller's Email" value="{{ $ad->seller_email }}" />
                            <x-input-item-field name="seller_mobile" type="text" label="Seller Phone" placeholder="Enter Seller's Phone" value="{{ $ad->seller_mobile }}" />
                            <x-input-item-field name="seller_address" type="text" label="Seller Address" placeholder="Enter Seller's Address" value="{{ $ad->seller_address }}" />
                            <x-ad-status-selectable :selected-status="$ad->status" />
                            <!--End Row-->
                        </div>
                        <div class="card-footer">
                            <!--Row-->
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary">Update Ad Listing</button>
                                    <a href="{{ route('admin.ads.show', $ad->slug) }}" class="btn btn-default float-end">Discard</a>
                                </div>
                            </div>
                            <!--End Row-->
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection
@push('scripts')
<!-- INTERNAL File-Uploads Js-->
<script src="/plugin/fancyuploader/jquery.ui.widget.js"></script>
<script src="/plugin/fancyuploader/jquery.fileupload.js"></script>
<script src="/plugin/fancyuploader/jquery.iframe-transport.js"></script>
<script src="/plugin/fancyuploader/jquery.fancy-fileupload.js"></script>
<script src="/plugin/fancyuploader/fancy-uploader.js"></script>
@endpush
@push('styles')
<style>
    .ck .ck-powered-by {
        display: none !important;
    }
</style>

@endpush