@extends('partials.admin')
@section('title', 'Payment Details' . ' - ' . $payment->txn_id)
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payments'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Payment Details', 'hasBack' => true, 'backTitle' => 'All Payments', 'backUrl' => route('admin.payments.index')])
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card productdesc">
                        <div class="card-body">
                            <div class="panel panel-primary">
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active pt-5" id="tab6" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td class="fw-bold">Transaction ID</td>
                                                            <td> <i class="fa-regular fa-money-from-bracket"></i>  {{ $payment->txn_id }} <i class="fa-regular fa-copy copy-text" onclick="copyTransactionID('{{ $payment->txn_id }}')"></i>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Payer Name</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="avatar bradius"
                                                                       style="background-image: url({{$payment->payer->avatar}})"></span>
                                                                    <div
                                                                       class="ms-3 mt-0 d-block">
                                                                       <a href="{{route('admin.users.show', $payment->payer->id)}}"
                                                                          class="mb-0 fs-14 fw-semibold text-info">
                                                                            {{ $payment->payer->name }}
                                                                       </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Payee Name</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="avatar bradius"
                                                                       style="background-image: url({{$payment->payee->avatar}})"></span>
                                                                    <div
                                                                       class="ms-3 mt-0 d-block">
                                                                       <a href="{{route('admin.users.show', $payment->payee->id)}}"
                                                                          class="mb-0 fs-14 fw-semibold text-info">
                                                                            {{ $payment->payee->name }}
                                                                       </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Amount</td>
                                                            <td> {{ money($payment->amount) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Status</td>
                                                            <td><span class="bg-{{ $payment->status->color() }} badge text-uppercase px-2">{{ $payment->status->label() }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Method</td>
                                                            <td class="text-capitalize"> {{ $payment->method ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Gateway</td>
                                                            <td> <span class="badge text-uppercase bg-{{ $payment->gateway->color() }}">{{ $payment->gateway->label() }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Payer Details</td>
                                                            <td> 
                                                                <div class="d-flex justify-content-between align-items-center flex-payer-wrap">
                                                                    <span> <i class="fa-regular fa-envelope"></i> Email: {{ $payment->payer_email }}</span>
                                                                    <span> <i class="fa-regular fa-globe"></i> IP Address: {{ $payment->client_ip }}</span>
                                                                    <span> <i class="fa-regular fa-credit-card"></i> Card Last 4: {{ $payment->card_last4 ?? 'N/A' }}</span>
                                                                    <span> <i class="fa-regular fa-credit-card"></i> Card ID: {{ $payment->card_id ?? 'N/A' }}</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Description</td>
                                                            <td> {{ $payment->description ?? 'No description provided' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Linked Bid</td>
                                                            <td> 
                                                                @if($payment->bid?->exists())
                                                                    <a href="{{ route('admin.bids.show', $payment->bid->id) }}">See linked bid here - {{ $payment->bid->id }}</a>
                                                                @else
                                                                    <span class="text-danger">No bid linked</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Linked Ad</td>
                                                            <td> 
                                                                @if($payment->ad?->exists())
                                                                    <a href="{{ route('admin.ads.show', $payment->ad->slug) }}">See linked ad here - {{ $payment->ad->title }}</a>
                                                                @else
                                                                    <span class="text-danger">No ad linked</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Linked Payout</td>
                                                            <td> 
                                                                @if($payment->payout?->exists())
                                                                    <a href="{{ route('admin.payments.show', $payment->payout->id) }}">See linked payout here - {{ $payment->payout->amount }}</a>
                                                                @else
                                                                    <span class="text-danger">No payout linked</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Created At</td>
                                                            <td> {{ $payment->created_at->format('d M Y h:i A') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
@push('scripts')
<script>
    function copyTransactionID(txn_id) {
        navigator.clipboard.writeText(txn_id);
        alert('Transaction ID copied to clipboard');
    }
</script>
@endpush