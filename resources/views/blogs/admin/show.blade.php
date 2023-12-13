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
                            @foreach ( $post->comments as $comment)
                            <div class="media mb-5 overflow-visible d-block d-sm-flex">
                                <div class="me-3 mb-2">
                                    <a href="profile.html"> <img class="media-object rounded-circle thumb-sm" alt="64x64" src="{{ $comment->user->avatar ?? $comment->admin->avatar }}"> </a>
                                </div>
                                <div class="media-body overflow-visible">
                                    <div class="border mb-5 p-4 br-5">
                                        <h5 class="mt-0">{{ $comment->user->name ?? $comment->admin->name }}</h5>
                                        <p class="font-13 text-muted">{{ $comment->content }}</p>
                                        <span class="reply" id="1">
                                            <a class="like" href="{{ route('admin.comments.edit', $comment->id) }}"><span class="badge btn-danger-light rounded-pill py-2 px-3"><i class="fa-regular fa-edit mx-1"></i>Edit</span></a>
                                            <a href="javascript:;" onclick="replyTo('{{$comment->id}}', '{{$comment->user->name ?? $comment->admin->name}}')"><span class="badge btn-primary-light rounded-pill py-2 px-3"><i class="fa-regular fa-reply mx-1"></i>Reply</span></a>
                                        </span>
                                    </div>
                                    @if ($comment->replies->count() > 0)
                                    @foreach ($comment->replies as $reply)
                                    <div class="media mb-5 overflow-visible">
                                        <div class="me-3">
                                            <a href="profile.html"> <img class="media-object rounded-circle thumb-sm" alt="64x64" src="{{ $reply->user->avatar ?? $reply->admin->avatar }}"> </a>
                                        </div>
                                        <div class="media-body border p-4 overflow-visible br-5">
                                            <h5 class="mt-0">{{ $reply->user->name ?? $reply->admin->name }}</h5>
                                            <span><i class="fe fe-thumb-up text-danger"></i></span>
                                            <p class="font-13 text-muted">{{ $reply->content }}</p>
                                            <a class="like" href="javascript:;"><span class="badge btn-danger-light rounded-pill py-2 px-3"><i class="fa-regular fa-edit mx-1"></i>Edit</span></a>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add a Comments</div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal  m-t-20" id="comment-form" action="{{ route('admin.blogs.comment.store', $post->slug) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <span id="reply-to-whom"></span>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <textarea name="content" class="form-control" rows="5">Your Comment*</textarea>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('content') }}</span>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-rounded  waves-effect waves-light">Submit</button>
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

<script>
    function replyTo(id, name) {
        // Scroll the page to the comment form
        document.getElementById('comment-form').scrollIntoView();
        // Set the name of the person to reply to
        document.getElementById('reply-to-whom').innerHTML = `Replying to ${name}`;
        // Set the value of the hidden input field to the id of the comment to reply to
        let commentIdInput = document.createElement('input');
        commentIdInput.setAttribute('type', 'hidden');
        commentIdInput.setAttribute('name', 'reply_to');
        commentIdInput.setAttribute('value', id);
        document.getElementById('comment-form').appendChild(commentIdInput);
    }
</script>
    
@endpush