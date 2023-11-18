@extends('partials.admin')
@section('title', 'Admin Blog Details - ' . $post->title)
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'blogs'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Blogs Details', 'hasBack' => true, 'backTitle' => 'All Blogs', 'backUrl' => route('admin.blogs.index')])
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div id="carousel-indicators2" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators carousel-indicators2">
                                @foreach ($post->media as $key => $media)
                                <li data-bs-target="#carousel-indicators2" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($post->media as $key => $media)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img class="card-img-top d-block w-100 br-5" alt="" src="{{ $media->url }}" data-bs-holder-rendered="true">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-md-flex">
                                <a href="javascript:void(0);" class="d-flex me-4 mb-2"><i class="fa-regular fa-calendar fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                                    <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">{{ $post->created_at->format('M d, Y') }}</div>
                                </a>
                                <a href="profile.html" class="d-flex mb-2"><i class="fa-regular fa-user fs-16 me-1 p-3 bg-primary-transparent text-primary bradius"></i>
                                    <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">{{ $post->admin->name }}</div>
                                </a>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="d-flex mb-2"><i class="fa-regular fa-message fs-16 me-1 p-3 bg-success-transparent text-success bradius"></i>
                                        <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">13 Comments</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3><a href="javascript:void(0)"> {{ $post->title }}</a></h3>
                            {!! $post->content !!}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Comments</div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="media mb-5 overflow-visible d-block d-sm-flex">
                                <div class="me-3 mb-2">
                                    <a href="profile.html"> <img class="media-object rounded-circle thumb-sm" alt="64x64" src="../assets/images/users/5.jpg"> </a>
                                </div>
                                <div class="media-body overflow-visible">
                                    <div class="border mb-5 p-4 br-5">
                                        <nav class="nav float-end">
                                            <div class="dropdown">
                                                <a class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:;" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-edit mx-1"></i> Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-corner-up-left mx-1"></i> Reply</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-flag mx-1"></i> Report Abuse</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-trash-2 mx-1"></i> Delete</a>
                                                </div>
                                            </div>
                                        </nav>
                                        <h5 class="mt-0">Gavin Murray</h5>
                                        <span><i class="fe fe-thumb-up text-danger"></i></span>
                                        <p class="font-13 text-muted">Lorem ipsum dolor sit amet, quis Neque porro quisquam est, nostrud exercitation ullamco laboris commodo consequat. There’s an old maxim that states, “No fun for the writer, no fun for the reader.”No matter
                                            what industry you’re working in, as a blogger, you should live and die by this statement.</p>
                                        <a class="like" href="javascript:;">
                                            <span class="badge btn-danger-light rounded-pill py-2 px-3">
                                                <i class="fe fe-heart me-1"></i>56</span>
                                        </a>
                                        <span class="reply" id="1">
                                            <a href="javascript:;"><span class="badge btn-primary-light rounded-pill py-2 px-3"><i class="fe fe-corner-up-left mx-1"></i>Reply</span></a>
                                        </span>
                                    </div>
                                    <div class="media mb-5 overflow-visible">
                                        <div class="me-3">
                                            <a href="profile.html"> <img class="media-object rounded-circle thumb-sm" alt="64x64" src="../assets/images/users/2.jpg"> </a>
                                        </div>
                                        <div class="media-body border p-4 overflow-visible br-5">
                                            <nav class="nav float-end">
                                                <div class="dropdown">
                                                    <a class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:;" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                                        <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-edit mx-1"></i> Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-corner-up-left mx-1"></i> Reply</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-flag mx-1"></i> Report Abuse</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-trash-2 mx-1"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </nav>
                                            <h5 class="mt-0">Mozelle Belt</h5>
                                            <span><i class="fe fe-thumb-up text-danger"></i></span>
                                            <p class="font-13 text-muted">Nostrud exercitation ullamco laboris commodo consequat. There’s an old maxim that states, “No fun for the writer, no fun for the reader.”No matter what industry you’re working in, as a blogger, you should
                                                live and die by this statement.</p>
                                            <a class="like" href="javascript:;"><span class="badge btn-danger-light rounded-pill py-2 px-3"><i class="fe fe-heart me-1"></i>56</span></a>
                                            <span class="reply" id="2">
                                                <a href="javascript:;"><span class="badge btn-primary-light rounded-pill py-2 px-3"><i class="fe fe-corner-up-left mx-1"></i>Reply</span></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media mb-5 overflow-visible">
                                <div class="me-3">
                                    <a href="profile.html"> <img class="media-object rounded-circle thumb-sm" alt="64x64" src="../assets/images/users/15.jpg"> </a>
                                </div>
                                <div class="media-body overflow-visible">
                                    <div class="border mb-5 p-4 br-5">
                                        <nav class="nav float-end">
                                            <div class="dropdown">
                                                <a class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:;" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-edit mx-1"></i> Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-corner-up-left mx-1"></i> Reply</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-flag mx-1"></i> Report Abuse</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-trash-2 mx-1"></i> Delete</a>
                                                </div>
                                            </div>
                                        </nav>
                                        <h5 class="mt-0">Paul Smith</h5>
                                        <p class="font-13 text-muted">Very nice ! On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the </p>
                                        <a class="like" href="javascript:;"><span class="badge btn-danger-light rounded-pill py-2 px-3"><i class="fe fe-heart me-1"></i>56</span></a>
                                        <span class="reply" id="3">
                                            <a href="javascript:;"><span class="badge btn-primary-light rounded-pill py-2 px-3"><i class="fe fe-corner-up-left mx-1"></i>Reply</span></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="media mb-5 overflow-visible d-block d-sm-flex">
                                <div class="me-3 mb-1">
                                    <a href="profile.html"> <img class="media-object rounded-circle thumb-sm" alt="64x64" src="../assets/images/users/5.jpg"> </a>
                                </div>
                                <div class="media-body overflow-visible">
                                    <div class="border mb-5 p-4 br-5">
                                        <nav class="nav float-end">
                                            <div class="dropdown">
                                                <a class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:;" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-edit mx-1"></i> Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-corner-up-left mx-1"></i> Reply</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-flag mx-1"></i> Report Abuse</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-trash-2 mx-1"></i> Delete</a>
                                                </div>
                                            </div>
                                        </nav>
                                        <h5 class="mt-0">Gavin Murray</h5>
                                        <span><i class="fe fe-thumb-up text-danger"></i></span>
                                        <p class="font-13 text-muted">Lorem ipsum dolor sit amet, quis Neque porro quisquam est, nostrud exercitation ullamco laboris commodo consequat. There’s an old maxim that states, “No fun for the writer, no fun for the reader.”No matter
                                            what industry you’re working in, as a blogger, you should live and die by this statement.</p>
                                        <a class="like" href="javascript:;"><span class="badge btn-danger-light rounded-pill py-2 px-3"><i class="fe fe-heart me-1"></i>56</span></a>
                                        <span class="reply" id="4">
                                            <a href="javascript:;"><span class="badge btn-primary-light rounded-pill py-2 px-3"><i class="fe fe-corner-up-left mx-1"></i>Reply</span></a>
                                        </span>
                                    </div>
                                    <div class="media mb-5 overflow-visible d-block d-sm-flex">
                                        <div class="me-3 mb-1">
                                            <a href="profile.html"> <img class="media-object rounded-circle thumb-sm" alt="64x64" src="../assets/images/users/2.jpg"> </a>
                                        </div>
                                        <div class="media-body overflow-visible">
                                            <div class="border p-4 mb-5 br-5">
                                                <nav class="nav float-end">
                                                    <div class="dropdown">
                                                        <a class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:;" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-edit mx-1"></i> Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-corner-up-left mx-1"></i> Reply</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-flag mx-1"></i> Report Abuse</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-trash-2 mx-1"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </nav>
                                                <h5 class="mt-0">Mozelle Belt</h5>
                                                <span><i class="fe fe-thumb-up text-danger"></i></span>
                                                <p class="font-13 text-muted">Nostrud exercitation ullamco laboris commodo consequat. There’s an old maxim that states, “No fun for the writer, no fun for the reader.”No matter what industry you’re working in, as a blogger, you
                                                    should live and die by this statement.</p>
                                                <a class="like" href="javascript:;"><span class="badge btn-danger-light rounded-pill py-2 px-3"><i class="fe fe-heart me-1"></i>56</span></a>
                                                <span class="reply" id="5">
                                                    <a href="javascript:;"><span class="badge btn-primary-light rounded-pill py-2 px-3"><i class="fe fe-corner-up-left mx-1"></i>Reply</span></a>
                                                </span>
                                            </div>
                                            <div class="media overflow-visible">
                                                <div class="me-3">
                                                    <a href="profile.html"> <img class="media-object rounded-circle thumb-sm" alt="64x64" src="../assets/images/users/9.jpg"> </a>
                                                </div>
                                                <div class="media-body border p-4 overflow-visible br-5">
                                                    <nav class="nav float-end">
                                                        <div class="dropdown">
                                                            <a class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:;" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-edit mx-1"></i> Edit</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-corner-up-left mx-1"></i> Reply</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-flag mx-1"></i> Report Abuse</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-trash-2 mx-1"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </nav>
                                                    <h5 class="mt-0">Paul Smith</h5>
                                                    <span><i class="fe fe-thumb-up text-danger"></i></span>
                                                    <p class="font-13 text-muted">Nostrud exercitation ullamco laboris commodo consequat. There’s an old maxim that states, “No fun for the writer, no fun for the reader.”No matter what industry you’re working in, as a blogger,
                                                        you should live and die by this statement.</p>
                                                    <a class="like" href="javascript:;"><span class="badge btn-danger-light rounded-pill py-2 px-3"><i class="fe fe-heart me-1"></i>56</span></a>
                                                    <span class="reply" id="6">
                                                        <a href="javascript:;"><span class="badge btn-primary-light rounded-pill py-2 px-3"><i class="fe fe-corner-up-left mx-1"></i>Reply</span></a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add a Comments</div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal  m-t-20" action="index.html">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="text" required="" placeholder="Username*">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="email" required="" placeholder="Email*">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <textarea class="form-control" rows="5">Your Comment*</textarea>
                                    </div>
                                </div>
                                <div class="">
                                    <a href="javascript:void(0)" class="btn btn-primary btn-rounded  waves-effect waves-light">Submit</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tags</div>
                        </div>
                        <div class="card-body">
                            <div class="tags">
                                @foreach ($post->tags as $tag)
                                <a href="javascript:void(0)" class="tag">{{ $tag->name }}</a>
                                @endforeach
                            </div>
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
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>
    
@endpush