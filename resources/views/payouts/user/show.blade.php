@extends('partials.app')
@section('title', 'Payout')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Payout', 'hasBack' => true, 'backUrl' => route('user.payouts'),
'backTitle' => 'Payout', 'routeItem' => $payment->txn_id])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'payouts', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="payout-wrapper">
                        <div class="payout-ad-wrapper d-flex row">
                            <div class="col-md-5">
                                <img class="img-fluid" src="{{$payment->ad->media->first()->url}}" class="Ad Image">
                            </div>
                            <div class="col-md-7">
                                <div class="payout-ad-details">
                                    <h3>Ad Details</h3>
                                    <h5>Title: {{$payment->ad->title}}</h5>
                                    <p class="para">{{shorten_chars($payment->ad->description, 200)}}</p>
                                    <div class="d-flex row mt-4">
                                        <div class="col-6">
                                            <p class="mb-0 fw-bolder text-gray-500">Status:</p>
                                            <h5 class="text-{{ $payment->ad->status->color() }}">{{$payment->ad->status->label()}}</h5>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0 fw-bolder text-gray-500">Price:</p>
                                            <h5>{{money($payment->ad->price)}}</h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="mt-4"><a href="{{route('user.ads.show', $payment->ad->slug)}}" class="cta-button text-white">View Ad <i class="fas fa-arrow-right"></i></a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="other-info pt-5">
                            <h3>Bid & Payment Information</h3>
                            <div class="row d-flex">
                                <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-top border-bottom border-end border-start">
                                    <div class="ad-listing-item">
                                        <span>Bid Amount:</span>
                                        <p><i class="fa fa-money-bill"></i> {{ money($payment->bid->amount) }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-top border-bottom border-end">
                                    <div class="ad-listing-item">
                                        <span>Bid By:</span>
                                        <p><i class="fa fa-user"></i> {{ $payment->payer->name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-end border-bottom border-top">
                                    <div class="ad-listing-item">
                                        <span>Payment ID:</span>
                                        <p><i class="fa fa-id-card"></i> {{ $payment->txn_id }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xl-3 col-md-6 col-sm-6 col-6 border-end border-bottom border-top">
                                    <div class="ad-listing-item">
                                        <span>Currency:</span>
                                        <p><i class="fa fa-money-bill"></i> {{ $payment->currency }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payout-wrapper pt-5">
                            <h3>Payout Details:</h3>
                            @if($payment->payout)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Payout ID</th>
                                        <th>Payout Method</th>
                                        <th>Amount Recieved</th>
                                        <th>Fee</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $payment->payout->pyt_token }}</td>
                                        <td class="fw-bolder">{{ $payment->payout->payoutMethod->account_number }}</td>
                                        <td>{{ money($payment->payout->amount) }}</td>
                                        <td>{{ money($payment->payout->fee) }}</td>
                                        <td><span class="badge bg-{{ $payment->payout->status->color() }}">{{ $payment->payout->status->label() }}</span></td>
                                        <td>{{ $payment->payout->created_at->format('d M Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @else
                            <div class="payout-form">
                                <x-payout-form :user="$payment->payee" :amount="$payment->amount" :txn-id="$payment->txn_id" />
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />
@push('scripts')
<script>
    function copyToClipboard(text) {
        var inputc = document.body.appendChild(document.createElement("input"));
        inputc.value = text;
        inputc.focus();
        inputc.select();
        document.execCommand('copy');
        inputc.parentNode.removeChild(inputc);
    }
</script>
@endpush
@endsection