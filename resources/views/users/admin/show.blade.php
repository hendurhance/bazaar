@extends('partials.admin')
@section('title', 'Admin Users Detail')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'users'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'User', 'hasBack' => true, 'backTitle' => 'All Users', 'backUrl' => route('admin.users.index')])

             <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">All User Detail</h3>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="row" id="user-profile">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="wideget-user mb-2">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row">
                                            <div class="panel profile-cover">
                                                <div class="profile-cover__action bg-img"></div>
                                                <div class="profile-cover__img">
                                                    <div class="profile-img-1">
                                                        <img src="{{ $user->avatar }}" alt="profile-img1">
                                                    </div>
                                                    <div class="profile-img-content text-dark text-start">
                                                        <div class="text-dark">
                                                            <h3 class="h3 mb-2">{{ $user->name }}</h3>
                                                            <h5 class="text-muted">{{ '@'.$user->username }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="px-0 px-sm-4">
                                                <div class="social social-profile-buttons mt-5 float-end">
                                                    <div class="mt-3 d-flex">
                                                        <a class="social-icon text-primary" href="mailto:{{ $user->email }}" target="_blank"><i class="fa-regular fa-envelope"></i></a>
                                                        <a class="social-icon text-primary" href="tel:{{ $user->mobile }}" target="_blank"><i class="fa-regular fa-phone"></i></a>
                                                        <a class="social-icon text-dark" href="{{ route('admin.users.edit', $user->id) }}"><i class="fa-regular fa-edit"></i></a>
                                                        <form action="{{ route('admin.users.destroy', $user->id)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="social-icon text-danger" type="submit"><i class="fa-regular fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-md-flex main-profile-contact-list">
                                        <div class="me-5">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-secondary bradius me-3 mt-1">
                                                    <i class="fa-regular fa-cube fs-20 text-white"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">Total Ads</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{$user->ads_count}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-5 mt-5 mt-md-0">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-danger bradius text-white me-3 mt-1">
                                                    <span class="mt-3">
                                                        <i class="fa-regular fa-gavel fs-20"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">Total Bids</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{$user->bids_count}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-5 mt-5 mt-md-0">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-dark bradius text-white me-3 mt-1">
                                                    <span class="mt-3">
                                                        <i class="fa-regular fa-credit-card fs-20"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">Total Methods</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{$user->payout_methods_count}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-5 mt-5 mt-md-0">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-warning bradius text-white me-3 mt-1">
                                                    <span class="mt-3">
                                                        <i class="fa-regular fa-credit-card fs-20"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">Total Paid</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{money($user->payments->sum('amount'), true)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-0 mt-5 mt-md-0">
                                            <div class="media">
                                                <div class="media-icon bg-primary text-white bradius me-3 mt-1">
                                                    <span class="mt-3">
                                                        <i class="fa-regular fa-money-bill fs-20"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">Total Payouts</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{money($user->payouts->sum('amount'), true)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">About</div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-location-crosshairs"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->address }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-map fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->city?->name }} {{ $user->state?->name . ', ' }} {{ $user->country?->name }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-phone fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->mobile }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-at fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->email }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-venus fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->gender->label() }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-mailbox fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->zip_code ?? 'Not Available' }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-light fa-earth-americas fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->timezone->name }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-ban fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->is_active ? 'Not Banned' : 'Banned' }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-light fa-calendar-days fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->created_at->format('d M, Y h:i A') }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-badge-check fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->email_verified_at->format('d M, Y h:i A') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">User Actions</div>
                                </div>
                                <div class="card-body">
                                    <div class="action-user">
                                        <a href="{{ route('admin.ads.index', ['search' => $user->id]) }}">See all user ads</a>
                                        <a href="{{ route('admin.bids.index', ['bid_id' => $user->id]) }}">See all user bids</a>
                                        <a href="{{ route('admin.payouts.index', ['pyt_token' => $user->id]) }}">See all user payouts</a>
                                        <a href="{{ route('admin.payments.index', ['txn_id' => $user->id]) }}">See all user payments</a>
                                        <a href="{{ route('admin.payout-methods.index', ['user_id' => $user->id] ) }}">See all user payout methods</a>
                                        <a href="{{ route('admin.support.index', ['search' => $user->id]) }}">See all user support tickets</a>
                                        <a href="{{ route('admin.media.index', ['search' => $user->id] ) }}">See all users media</a>
                                        <a href="{{ route('admin.comments.index', ['search' => $user->id] ) }}">See all user comments</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL-END -->
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