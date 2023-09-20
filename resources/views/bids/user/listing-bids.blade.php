@extends('partials.app')
@section('title', 'Listing Bids')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Listing Bids'])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'bidding'])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="table-title-area">
                    <h3>Listing Bids</h3>
                    </div>
                    @if($bids->count() > 0)
                    <div class="table-wrapper">
                        <table class="eg-table order-table table mb-0">
                            <thead>
                                <tr>
                                    <th>Ad Title</th>
                                    <th>Timeframe</th>
                                    <th>Bid Amount</th>
                                    <th>Ad Status</th>
                                    <th>Bid Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bids as $bid)
                                <tr>
                                    <td data-label="Ad Title"><a href="{{ route('auction-details', $bid->ad->slug) }}" class="text-dark">{{ shorten_chars($bid->ad->title, 20) }}</a></td>
                                    <td data-label="Timeframe">{{ $bid->ad->started_at->format('d M Y') }} - {{ $bid->ad->expired_at->format('d M Y') }}</td>
                                    <td data-label="Bid Amount">${{ number_format($bid->amount) }}</td>
                                    <td data-label="Status" class="text-{{ $bid->ad->status->color() }}">{{ $bid->ad->status->label() }}</td>
                                    <td data-label="Bid Status" class="text-{{ is_null($bid->is_accepted) ? 'warning' : ( $bid->is_accepted ? 'success' : 'danger' ) }}">{{ is_null($bid->is_accepted) ? 'Pending' : ( $bid->is_accepted ? 'Accepted' : 'Rejected' ) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $bids->links('pagination.simple') }}
                    @else
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/icons/man.svg') }}" alt="empty" class="w-25">
                        </div>
                        <x-alert type="dark">
                            <p class="text-center mb-0"><strong>Sorry!</strong> You have no bids on any listing currently. To bid on a listing, click <a href="{{ route('live-auction') }}" class="fw-bold">here</a>.</p>
                        </x-alert>
                    </div>
                    @endif
                </div>
          </div>
        </div>
    </div>
</div>

@include('layouts.metrics')

@endsection