@extends('partials.admin')
@section('title', 'Admin Failed Payouts')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payouts.failed'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'All Failed Payouts', 'hasBack' => true, 'backTitle' => 'All Payouts', 'backUrl' => route('admin.payouts.index')])
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">All Failed Payouts</h3>
                        </div>
                        <div class="">
                            <x-filter-admin-payout-card />
                        </div>
                        <x-admin-payout-table :payouts="$failedPayouts" />
                    </div>
                </div>
            </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection

@push('scripts')
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>
@endpush