@extends('partials.app')
@section('title', 'Live Auction')
@section('description', 'View current live auctions, and bid on items.')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Live Auction'])

<div class="live-auction-section pt-120 pb-120">
    <div class="container">
        <x-ad-filter-component/>
        <div class="row gy-4 mb-60 d-flex justify-content-center">
            @foreach ($ads as $ad)
                <x-ad-item-card :ad="$ad" type="default"/>
            @endforeach
        </div>
        <div class="row">
            <nav class="pagination-wrap">
                <ul class="pagination d-flex justify-content-center gap-md-3 gap-2">
                    <li class="page-item">
                        <a class="page-link" href="#" tabindex="-1">Prev</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">01</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">02</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@include('layouts.metrics')

@endsection