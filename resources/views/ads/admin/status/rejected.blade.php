@extends('partials.admin')
@section('title', 'Admin Rejected Ads')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'ads.rejected'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Rejected Ads Listing', 'hasBack' => true, 'backTitle' => 'Ads Listing', 'backUrl' => route('admin.ads.index')])
            <div class="row">
                <div class="col-12 col-sm-12">
                   <div class="card">
                      <div class="card-header">
                         <h3 class="card-title mb-0">All Rejected Ads</h3>
                      </div>
                      <x-admin-ad-table :collection="$ads" />
                   </div>
                </div>
             </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection