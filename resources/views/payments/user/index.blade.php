@extends('partials.app')
@section('title', 'Purchases')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Purchases'])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'purchase'])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="table-title-area">
                       <h3>Purchases</h3>
                       <form class="d-flex align-items-center">
                       <select name="status">
                        <option value=""> Show: All Purchases (Filter)</option>
                        <option value="pending" @selected(request()->status == 'pending')>Show: Pending Listing</option>
                        <option value="active" @selected(request()->status == 'active')>Show: Active Listing</option>
                        <option value="upcoming" @selected(request()->status == 'upcoming')>Show: Upcoming Listing</option>
                        <option value="expired" @selected(request()->status == 'expired')>Show: Expired Listing</option>
                        <option value="rejected" @selected(request()->status == 'rejected')>Show: Rejected Listing</option>
                     </select>
                     <button type="submit" class="filter-btn bg-dark text-white ml-2">Filter</button>
                    </form>
                    </div>
                    @if($payments->count() > 0)
                    <div class="table-wrapper">
                       <table class="eg-table order-table table mb-0">
                          <thead>
                             <tr>
                                <th>Ads Title</th>
                                <th>Starting Price</th>
                                <th>Timeframe</th>
                                <th>Status</th>
                                <th>Action</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td data-label="Title">Auction Title 01</td>
                                <td data-label="Bidding ID">Bidding_HvO253gT</td>
                                <td data-label="Bid Amount(USD)">1222.8955</td>
                                <td data-label="Image"><img alt="image" src="assets/images/bg/order1.png" class="img-fluid"></td>
                                <td data-label="Status" class="text-green">Successfully</td>
                                <td data-label="Action"><button class="eg-btn action-btn green"><img alt="image" src="assets/images/icons/aiction-icon.svg"></button></td>
                            </tr>
                            @endforeach
                          </tbody>
                       </table>
                    </div>
                    {{ $payments->links('pagination.simple') }}
                    @else
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/icons/man.svg') }}" alt="empty" class="w-25">
                        </div>
                        <x-alert type="dark">
                            <p class="text-center mb-0"><strong>Sorry!</strong> You have no ad purchases yet. Ads you purchase will appear here.</p>
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