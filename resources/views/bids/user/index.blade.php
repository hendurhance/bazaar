@extends('partials.app')
@section('title', 'Ads Listing')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Ads Listing'])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'ads'])
            <div class="col-lg-9">
                <div class="tab-pane">
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.metrics')

@endsection