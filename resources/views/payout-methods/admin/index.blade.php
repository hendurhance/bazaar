@extends('partials.admin')
@section('title', 'Admin Payout Methods')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payout-methods'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Payout Methods', 'hasBack' => true, 'backTitle' => 'Dashboard', 'backUrl' => route('admin.dashboard')])

             <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">All Payout Methods</h3>
                        </div>
                        <div class="">
                           <x-filter-admin-payout-method-card />
                        </div>
                        <div class="card-body pt-4">
                            <div class="grid-margin">
                                <div class="">
                                    <div class="panel panel-primary">
                                        <div class="panel-body tabs-menu-body border-0 pt-0">
                                            @if(count($payoutMethods) > 0)
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab5">
                                                    <div class="table-responsive">
                                                        <div id="data-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                            <div class="row">
                                                                <table id="data-table" class="table table-bordered text-nowrap mb-0">
                                                                    <thead class="border-top">
                                                                        <tr>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                User</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                Bank</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                Account Name</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                Account Number</th>
                                                                            <th class="bg-transparent border-bottom-0"
                                                                                style="width: 10%;">Country</th>
                                                                            <th class="bg-transparent border-bottom-0"
                                                                                style="width: 5%;">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($payoutMethods as $payoutMethod)
                                                                        <tr class="border-bottom">
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <span class="avatar bradius"
                                                                                        style="background-image: url({{$payoutMethod->user->avatar}})"></span>
                                                                                    <div
                                                                                        class="ms-3 mt-0 mt-sm-2 d-block">
                                                                                        <h6
                                                                                            class="mb-0 fs-14 fw-semibold">
                                                                                            {{$payoutMethod->user->name}}</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div
                                                                                        class="mt-0 mt-sm-3 d-block">
                                                                                        <h6
                                                                                            class="mb-0 fs-14 fw-semibold">{{$payoutMethod->bank_name}}</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <span class="mt-sm-2 d-block"> {{ $payoutMethod->account_name }} </span>
                                                                            </td>
                                                                            <td>
                                                                                <span class="mt-sm-2 d-block"> {{ mask_chars($payoutMethod->account_number, 0,4) }} </span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="mt-sm-1 d-block">
                                                                                    <span class="mt-sm-2 d-block">{{ $payoutMethod->country->emoji }} - {{ $payoutMethod->country->name }} </span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="mt-sm-1 d-block">
                                                                                    <a href="{{ route('admin.payout-methods.show', $payoutMethod->id) }}" class="btn text-dark btn-sm"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-original-title="View"><span
                                                                                        class="fa-regular fa-eye fs-14"></span>
                                                                                    </a>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            {{ $payoutMethods->links('pagination.admin') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="text-center p-4">
                                                <img src="{{ asset('assets/images/icons/man.svg') }}" class="w-25" alt="empty">
                                                <h4 class="mt-3">No Payout Method Found</h4>
                                            </div>
                                            @endif
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
    // Copy BidID
    function copyBidID(id) {
        const copyText = id;
        navigator.clipboard.writeText(copyText);
    }
</script>
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>
    
@endpush