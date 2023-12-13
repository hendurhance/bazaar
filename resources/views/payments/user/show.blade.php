@extends('partials.app')
@section('title', 'Payments')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Payments', 'hasBack' => true, 'backUrl' => route('user.payments'), 'backTitle' => 'payments', 'routeItem' => $payment->txn_id])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'payments', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="payment-detail-wrapper">
                        <div class="mb-4">
                            <h3>Payment Details</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="payment-detail-item">
                                    <span>Transaction ID:</span>
                                    <h5>{{ $payment->txn_id }} <a href="javascript:void(0)" onclick="copyToClipboard('{{ $payment->txn_id }}')" title="Copy to clipboard" data-bs-toggle="tooltip" data-bs-placement="top" class="copy-btn" data-clipboard-text="{{ $payment->txn_id }}"><i class="far fa-copy"></i></a></h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="payment-detail-item">
                                    <span>Amount:</span>
                                    <h5>{{ money($payment->amount) }}</h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="payment-detail-item">
                                    <span>Payment Method:</span>
                                    <h5 class="bg-{{ $payment->gateway->color() }} text-white text-uppercase rounded-3 py-1 px-2">{{ $payment->gateway->label() }}</h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="payment-detail-item">
                                    <span>Status:</span>
                                    <h5 class="text-{{ $payment->status->color() }}">{{ $payment->status->label() }}</h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="payment-detail-item">
                                    <span>Date:</span>
                                    <h5>{{ $payment->created_at->format('d M, Y h:i A') }}</h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="payment-detail-item">
                                    <span>Payer Email:</span>
                                    <h5>{{ $payment->payer_email }}</h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="payment-detail-item">
                                    <span>Bid Paid For:</span>
                                    <h5><a href="{{ route('user.listing-bids.show', $payment->bid->id) }}" class="text-green">View Bid</a></h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="payment-detail-item">
                                    <span>Ad Paid For:</span>
                                    <h5><a href="{{ route('auction-details', $payment->bid->ad->slug) }}" class="text-green">View Ad</a></h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="payment-detail-item">
                                    <span>Payment Description:</span>
                                    <h5>{{ $payment->description ?? 'No description' }}</h5>
                                </div>
                            </div>
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