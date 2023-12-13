@extends('partials.admin')
@section('title', 'Admin Pending Payments')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payments.pending'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'All Pending Payments', 'hasBack' => true, 'backTitle' => 'All Payments', 'backUrl' => route('admin.payments.index')])
            <div class="row">
                <div class="col-12 col-sm-12">
                   <div class="card">
                      <div class="card-header">
                         <h3 class="card-title mb-0">All Pending Payments</h3>
                      </div>
                      <div class="">
                        <x-filter-admin-payment-card />
                    </div>
                    <x-admin-payment-table :payments="$pendingPayments" />
                   </div>
                </div>
             </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection