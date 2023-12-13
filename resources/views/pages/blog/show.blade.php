@extends('partials.app')
@section('title', $post->title . ' | Blog')
@section('description', shorten_chars($post->content, 150, true))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Blog'])

<div class="blog-details-section pt-120 pb-120">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-8">
                <div class="blog-details-single">
                    <div class="blog-img">
                        <img alt="image" src="{{ $post->featured_image_url }}" class="img-fluid wow fadeInDown"
                            data-wow-duration="1.5s" data-wow-delay=".2s"
                            style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    </div>
                    <ul class="blog-meta gap-2">
                        <li><a href="#"><img alt="image" src="/assets/images/icons/calendar.svg">Date: {{
                                $post->created_at->format('d M Y') }}</a></li>
                        </li>
                        <li><a href="#"><img alt="image" src="/assets/images/icons/tags.svg">Auction</a></li>
                        <li><a href="#"><img alt="image" src="/assets/images/icons/admin.svg">Posted by {{
                                $post->admin->name }}</a></li>
                    </ul>
                    <h3 class="blog-title">{{ $post->title }}</h3>
                    <div class="blog-content">
                        {!! $post->content !!}
                    </div>
                    <div class="blog-video-area">
                        <div class="row g-4">
                           {{-- skip the first media --}}
                            @foreach ($post->media()->get()->skip(1) as $media)
                            <div class="col-md-6">
                                <img alt="image" src="{{ $media->url }}" class="img-fluid">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="blog-tag">
                        <div class="row g-3">
                            <div
                                class="col-md-6 d-flex justify-content-md-start justify-content-center align-items-center">
                                <h6>Post Tag:</h6>
                                <ul class="tag-list">
                                    @foreach ($post->tags()->get() as $tag)
                                    <li><a href="{{ route('blog.index', ['tag' => $tag->id]) }}">{{ $tag->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div
                                class="col-md-6 d-flex justify-content-md-end justify-content-center align-items-center">
                                <ul class="share-social gap-3">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest-alt"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="blog-author gap-4 flex-md-nowrap flex-wrap">
                        <div class="author-image">
                            <img alt="image" src="{{ $post->admin->avatar }}" class="img-fluid">
                        </div>
                        <div class="author-detials text-md-start text-center">
                            <h5>-- {{ $post->admin->name }}</h5>
                            <p class="para">Article by {{ $post->admin->name }}. {{ $post->admin->name }} is a
                                professional blogger and content writer.</p>
                        </div>
                    </div>
                    <div class="blog-comment">
                        <div class="blog-widget-title">
                            <h4>Comments (03)</h4>
                            <span></span>
                        </div>
                        <ul class="comment-list mb-50">
                            @foreach ($post->comments as $comment)
                            <li>
                                <div class="comment-box">
                                    <div class="comment-header d-flex justify-content-between align-items-center">
                                        <div class="author d-flex flex-wrap">
                                            <img alt="image" src="{{ $comment->user->avatar ?? $comment->admin->avatar }}">
                                            <h5><a href="#"> {{ $comment->user->name ?? $comment->admin->name }}</a></h5><span class="commnt-date"> {{ $comment->created_at->format('M d, Y') }} </span>
                                        </div>
                                        <a href="javascript:void(0)" onclick="replyTo('{{$comment->id}}', '{{$comment->user->name ?? $comment->admin->name}}')" class="commnt-reply"><i class="bi bi-reply"></i></a>
                                    </div>
                                    <div class="comment-body">
                                        <p class="para">{{ $comment->content }}</p>
                                    </div>
                                </div>
                                @if($comment->replies()->count() > 0)
                                <ul class="comment-reply">
                                    @foreach ($comment->replies as $reply)
                                    <li>
                                        <div class="comment-box">
                                            <div
                                                class="comment-header d-flex justify-content-between align-items-center">
                                                <div class="author d-flex flex-wrap">
                                                    <img alt="image" src="{{ $reply->user->avatar ?? $reply->admin->avatar }}">
                                                    <h5><a href="#"> {{ $reply->user->name ?? $reply->admin->name }}</a></h5><span class="commnt-date"> {{ $reply->created_at->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="comment-body">
                                                <p class="para">{{ $reply->content }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="comment-form">
                        <div class="blog-widget-title style2">
                            <h4>Leave A Comment</h4>
                            <p class="para">Your email address will not be published.</p>
                            <span></span>
                        </div>
                        @auth('web')
                        <form id="comment-main" action="{{ route('blog.comment.store', $post->slug) }}" method="POST">
                            @csrf
                            <div class="row">
                                <span class="para mb-3 h5 text-primary" id="reply-to-who"></span>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <input type="text" placeholder="Your Name :" value="{{ auth()->user()->name }}" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <input type="email" placeholder="Your Email :" value="{{ auth()->user()->email }}" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-inner">
                                        <textarea name="content" placeholder="Write Message :" rows="12"></textarea>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('content') }}</span>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="eg-btn btn--primary btn--md form--btn">Submit Now</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <x-alert type="warning" icon="exclamation-triangle">
                            <p class="mb-0">You must be logged in to comment. If you have an account, please <a
                                    class="fw-bold" href="{{ route('user.login') }}">login</a> to comment.</p>
                        </x-alert>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="blog-sidebar">
                    <div class="blog-widget-item wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="search-area">
                            <div class="sidebar-widget-title">
                                <h4>Search From Blog</h4>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <form method="GET" action="{{ route('blog.index') }}">
                                    <div class="form-inner">
                                        <input name="search" type="text" placeholder="Search Here">
                                        <button class="search--btn"><i class="bx bx-search-alt-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="blog-widget-item wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".4s"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <div class="blog-category">
                            <div class="sidebar-widget-title">
                                <h4>Related Post</h4>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="recent-post">
                                    @foreach ($post->relatedPosts()->get() as $relatedPost)
                                    <li class="single-post">
                                        <div class="post-img">
                                            <a href="{{ route('blog.show', $relatedPost->slug) }}"><img alt="image"
                                                    src="{{ $relatedPost->featured_image_url }}"></a>
                                        </div>
                                        <div class="post-content">
                                            <span>{{ $relatedPost->created_at->format('d M Y') }}</span>
                                            <h6><a href="{{ route('blog.show', $relatedPost->slug) }}">{{
                                                    $relatedPost->title }}</a></h6>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <x-post-tag-card />

                    <div class="blog-widget-item wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".8s"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.8s; animation-name: fadeInUp;">
                        <div class="tag-area">
                            <div class="sidebar-widget-title">
                                <h4>Follow Social</h4>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="sidebar-social-list gap-4">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest-alt"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-banner wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 1s; animation-name: fadeInUp;">
                        <div class="banner-content">
                            <span>Advertisement</span>
                            <h3>Toyota AIGID A Clasis Cars Sale</h3>
                            {{-- <a href="{{ route('auction-details') }}"
                                class="eg-btn btn--primary card--btn">Details</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@endsection

@push('scripts')
<script>
    function replyTo(id, name) {
        let commentBox = document.querySelector('.comment-form');
        commentBox.scrollIntoView();
        document.querySelector('#reply-to-who').innerHTML = `Reply to ${name}`;
        // Create a new hidden input field for the comment id
        let commentIdInput = document.createElement('input');
        commentIdInput.setAttribute('type', 'hidden');
        commentIdInput.setAttribute('name', 'reply_to');
        commentIdInput.setAttribute('value', id);
        // Append the input field to the form
        document.querySelector('#comment-main').appendChild(commentIdInput);
    }
</script>
