@extends('partials.admin')
@section('title', 'Admin Resolved Support')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'support.resolved'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'All Resolved Support', 'hasBack' => true, 'backTitle' => 'All Support', 'backUrl' => route('admin.support.index')])
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">All Resolved Support</h3>
                        </div>
                        <div class="">
                            <x-filter-admin-support-card />
                        </div>
                        <x-admin-support-table :supports="$resolvedSupports" />
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