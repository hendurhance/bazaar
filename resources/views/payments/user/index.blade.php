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
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Bid</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td data-label="Transaction ID">{{ $payment->txn_id }} <a href="javascript:void(0)" onclick="copyToClipboard('{{ $payment->txn_id }}')" title="Copy to clipboard" data-bs-toggle="tooltip" data-bs-placement="top" class="copy-btn" data-clipboard-text="{{ $payment->txn_id }}"><i class="far fa-copy"></i></a>
                                <td data-label="Amount" class="text-green">{{ money($payment->amount) }}</td>
                                <td data-label="Payment Method" class="text-{{ $payment->gateway->color() }}">{{ $payment->gateway->label() }}</td>
                                <td data-label="Status" class="fw-bold text-{{ $payment->status->color() }}">{{ $payment->status->label() }}</td>
                                <td data-label="Date">{{ $payment->created_at->format('d M, Y h:i A') }}</td>
                                <td data-label="Bid"><a href="{{ route('user.purchase.show', $payment->txn_id) }}" class="eg-btn action-btn green text-white"><i class="fas fa-eye"></i> View</a></td>
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