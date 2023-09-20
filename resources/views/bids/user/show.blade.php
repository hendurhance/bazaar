@extends('partials.app')
@section('title', 'Listing Bid'. ' - '.$bid->ad->title)
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Listing Bid', 'hasBack' => true, 'backUrl' => route('user.listing-bids'), 'backTitle' => 'Listing Bids', 'routeItem' => $bid->ad->title])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'bidding'])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="table-title-area">
                    <h3>Listing Bid</h3>
                    </div>
                    
                </div>
          </div>
        </div>
    </div>
</div>

@include('layouts.metrics')

@endsection