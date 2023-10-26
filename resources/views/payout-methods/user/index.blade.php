@extends('partials.app')
@section('title', 'Payout Methods')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Payouts'])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'payout-method', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="table-title-area pb-4">
                        <h2>Payout Method</h2>
                        @if($payoutMethods->count() < 3)
                        <a href="{{ route('user.payout-methods.create')}}" class="filter-btn btn--primary btn--md">Create Payout Method</a>
                        @endif
                    </div>
                    @if($payoutMethods->count() > 0)
                    <div class="table-wrapper">
                       <table class="eg-table order-table table mb-0">
                          <thead>
                             <tr>
                                <th>Bank Name</th>
                                <th>Account Name</th>
                                <th>Account Number</th>
                                <th>Date Created</th>
                                <th class="border-bottom-0">Action</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach($payoutMethods as $payout)
                            <tr>
                                <td data-label="Bank Name">{{ $payout->bank_name }}</td>
                                <td data-label="Account Name">{{ $payout->account_name }}</td>
                                <td data-label="Account Number">{{ $payout->account_number }}</td>
                                <td data-label="Date Created">{{ $payout->created_at->format('D M Y') }}</td>
                                <td data-label="Action" class="d-flex">
                                    <a href="{{ route('user.payout-methods.edit', $payout->id) }}" class="eg-btn action-btn green text-white"><i class="fa-regular fa-edit"></i> Edit</a>
                                    <form action="{{ route('user.payout-methods.destroy', $payout->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="eg-btn action-btn green text-white bg-danger ml-2"><i class="fa-regular fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                       </table>
                    </div>
                    {{ $payoutMethods->links('pagination.simple') }}
                    @else
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/icons/man.svg') }}" alt="empty" class="w-25">
                        </div>
                        <x-alert type="dark">
                            <p class="text-center mb-0"><strong>Sorry!</strong> You have not have any payout method yet. Payout methods you create will appear here.</p>
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