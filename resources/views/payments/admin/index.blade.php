@extends('partials.admin')
@section('title', 'Admin Payment')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payments.all'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'All Payments', 'hasBack' => true,
            'backTitle' => 'Dashboard', 'backUrl' => route('admin.dashboard')])
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">All Payments</h3>
                        </div>
                        <div class="">
                            <x-filter-admin-payment-card />
                        </div>
                        <x-admin-payment-table :payments="$payments" />
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
    function copyTransactionID(id) {
            const copyText = id;
            navigator.clipboard.writeText(copyText);
        }
</script>
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>
@endpush