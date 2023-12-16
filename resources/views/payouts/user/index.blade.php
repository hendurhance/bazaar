@extends('partials.app')
@section('title', 'Payouts')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Payouts'])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'payouts', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <x-payout-filter-component />
                    @if($payments->count() > 0)
                    <div class="table-wrapper">
                       <table class="eg-table order-table table mb-0">
                          <thead>
                             <tr>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Request Payout</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td data-label="Transaction ID">{{ $payment->txn_id }} <a href="javascript:void(0)" onclick="copyToClipboard('{{ $payment->txn_id }}')" title="Copy to clipboard" data-bs-toggle="tooltip" data-bs-placement="top" class="copy-btn" data-clipboard-text="{{ $payment->txn_id }}"><i class="far fa-copy"></i></a>
                                <td data-label="Amount" class="text-green">{{ money($payment->amount) }}</td>
                                <td data-label="Payment Method" class="text-{{ $payment->gateway->color() }}">{{ $payment->gateway->label() }}</td>
                                <td data-label="Status" class="fw-bold text-{{ $payment->status->color() }}">{{ $payment->status->label() }}</td>
                                <td data-label="Date">{{ $payment->created_at->format('D M Y') }}</td>
                                @if($payment->status === \App\Enums\PaymentStatus::SUCCESS)
                                <td data-label="Request Payout"><a href="{{ route('user.payouts.show', $payment->txn_id) }}" class="eg-btn action-btn green text-white"><i class="fa-regular fa-money-simple-from-bracket"></i> Request Payout</a></td>
                                @else
                                <td data-label="Request Payout">No Action</td>
                                @endif
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
                            <p class="text-center mb-0"><strong>Sorry!</strong> You have not received any payments yet. Payments you receive will appear here.</p>
                        </x-alert>
                    </div>
                    @endif
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