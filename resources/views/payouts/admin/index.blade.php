@extends('partials.admin')
@section('title', 'Admin Payouts')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payouts.all'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'All Payouts', 'hasBack' => true, 'backTitle' => 'Dashboard', 'backUrl' => route('admin.dashboard')])
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">All Payouts</h3>
                        </div>
                        <div class="">
                            <x-filter-admin-payout-card />
                        </div>
                        <x-admin-payout-table :payouts="$payouts" />
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