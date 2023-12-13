@extends('partials.app')
@section('title', 'Create Payout Method')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Create Payout Method'])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'payout-method', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <form class="w-100" action="{{ route('user.payout-methods.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-section">
                                    <h4>Bank Information</h4>
                                </div>
                                <div class="col-md-12">
                                   <select name="bank_code">
                                       <option value="">Select Bank</option>
                                       @foreach($banks as $bank)
                                        <option value="{{ $bank['code'] }}" @selected(old('bank_code') == $bank['code'])>{{ $bank['name'] }}</option>
                                        @endforeach
                                   </select>
                                   <span class="text-danger">{{ $errors->first('bank_code') }}</span>
                                </div>
                                <div class="form-section">
                                    <h4>Account Information</h4>
                                </div>
                                <div class="col-md-12">
                                    <x-input-field name="account_name" type="text" label="Account Name" placeholder="Enter Account Name" value="{{ old('account_name') }}" />
                                </div>
                                <div class="col-md-12">
                                    <x-input-field name="account_number" type="number" label="Account Number" placeholder="Enter Account Number" value="{{ old('account_number') }}" />
                                </div>
                            </div>
                            <button class="account-btn">Create Payout Method</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@amplifiedhq/countries-atlas/dist/flags/css/flags.min.css" async defer>
@endpush

@endsection