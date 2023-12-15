@extends('partials.admin')
@section('title', 'Admin Dashboard Search')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'dashboard'])

<div class="main-content app-content mt-0">
  <div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">
      @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Search'])


      <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-body pb-0">
                    <form action="{{route('admin.search')}}" class="input-group mb-2">
                        <input type="text" class="form-control" placeholder="Searching....." value="{{request()->q}}" name="q">
                        <button type="submit" class="input-group-text btn btn-primary">Search</button>
                    </form>
                    <div class="tabs-menu search-tabs">
                        <ul class="nav panel-tabs" role="tablist">
                            <li><a href="#tab5" class="active" data-bs-toggle="tab" aria-selected="true" role="tab">Users</a></li>
                            <li><a href="#tab6" data-bs-toggle="tab" class="text-dark" aria-selected="false" tabindex="-1" role="tab">Images</a></li>
                            <li><a href="#tab7" data-bs-toggle="tab" class="text-dark" aria-selected="false" tabindex="-1" role="tab">Bid</a></li>
                            <li><a href="#tab8" data-bs-toggle="tab" class="text-dark" aria-selected="false" tabindex="-1" role="tab">Ads</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-5">
                    <p class="text-muted mb-0 ps-3">About {{$total}} results ({{number_format($seconds, 2)}} seconds)</p>
                </div>
            </div>
            <div class="panel-body tabs-menu-body p-0 border-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5" role="tabpanel">
                        @if($model_flag['user'] == true)
                        @foreach ($results as $item)
                        @if($item instanceof \App\Models\User)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ $item->avatar }}" alt="" class="rounded-circle" width="50" height="50">
                                    </div>
                                    <div class="col-md-11">
                                        <div class="mb-2">
                                            <a href="{{ route('admin.users.show', $item->id) }}" class="h4 text-dark">{{$item->name}}</a>
                                        </div>
                                        <a href="javascript:void(0)" class="text-primary">{{'@'.$item->username}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center p-4">
                                    <img src="{{ asset('assets/images/icons/man.svg') }}" class="w-25" alt="empty">
                                    <h4 class="mt-3">No User Found</h4>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane" id="tab6" role="tabpanel">
                        <div class="demo-gallery card">
                            <div class="card-body">
                                <ul id="lightgallery" class="list-unstyled row" lg-uid="lg0">
                                    @if($model_flag['media'] == true)
                                    @foreach ($results as $item)
                                    @if($item instanceof \App\Models\Media)
                                    <li class="col-xs-6 col-sm-4 col-md-4 col-xl-3 mb-5 border-bottom-0" data-responsive="{{ $item->url }}" data-src="{{ $item->url }}" data-sub-html="<h4>Gallery Image 1</h4><p> Many desktop publishing packages and web page editors now use Lorem Ipsum</p>" lg-event-uid="&amp;1">
                                        <a href="{{ route('admin.media.show', $item->id) }}">
                                            <img class="img-responsive br-5" src="{{ $item->url }}" alt="Thumb-1">
                                            <p class="text-muted mt-2 mb-0">{{ $item->name }}</p>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                    @else
                                    <div class="text-center p-4">
                                        <img src="{{ asset('assets/images/icons/man.svg') }}" class="w-25" alt="empty">
                                        <h4 class="mt-3">No Images Found</h4>
                                    </div>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab7" role="tabpanel">
                        @if($model_flag['bid'] == true)
                        @foreach ($results as $item)
                        @if($item instanceof \App\Models\Bid)
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-2">
                                    <a href="{{route('admin.bids.show', $item->id)}}" class="h4 text-dark">{{$item->ad?->title}}</a>
                                </div>
                                <div>
                                    <span class="me-4 d-inline-block"><strong>Bidded by: </strong> <a href="{{route('admin.users.show', $item->user?->id)}}"> {{$item->user?->name}}</a></span>
                                    <span class="fw-semibold">{{money($item->amount)}}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center p-4">
                                    <img src="{{ asset('assets/images/icons/man.svg') }}" class="w-25" alt="empty">
                                    <h4 class="mt-3">No Bid Found</h4>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane" id="tab8" role="tabpanel">
                        @if($model_flag['ad'] == true)
                        @foreach ($results as $item)
                        @if($item instanceof \App\Models\Ad)
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-2">
                                    <a href="{{route('admin.ads.show', $item->slug)}}" class="h4 text-dark">{{$item->title}}</a>
                                </div>
                                <div class="tags mb-2">
                                    <span class="tag"> {{$item->category?->name}}</span>
                                    <span class="tag">{{$item->subCategory?->name}}</span>
                                </div>
                                <a href="{{ route('auction-details', $item->slug) }}" class="text-primary">{{url('auction-details', $item->slug)}}</a>
                                <p class="text-muted mt-2 mb-1">{{shorten_chars($item->description, 200, true)}}</p>
                                <div>
                                    <a href="javascript:void(0)" class="fw-semibold">{{money($item->price)}}</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center p-4">
                                    <img src="{{ asset('assets/images/icons/man.svg') }}" class="w-25" alt="empty">
                                    <h4 class="mt-3">No Bid Found</h4>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-center">
                <div class="mb-5">
                    {{ $results->appends(request()->q)->links('pagination.search') }}
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- CONTAINER END -->
  </div>
</div>


@endsection
@push('scripts')

@endpush