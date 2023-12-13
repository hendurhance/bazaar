@extends('partials.admin')
@section('title', 'Admin Successful Payments')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payments.successful'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'All Successful Payments', 'hasBack' => true, 'backTitle' => 'All Payments', 'backUrl' => route('admin.payments.index')])
            <div class="row">
                <div class="col-12 col-sm-12">
                   <div class="card">
                      <div class="card-header">
                         <h3 class="card-title mb-0">All Successful Payments</h3>
                      </div>
                      <div class="">
                        <x-filter-admin-payment-card />
                    </div>
                    <x-admin-payment-table :payments="$successfulPayments" />
                   </div>
                </div>
             </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection