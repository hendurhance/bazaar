@extends('partials.app')
@section('title', 'Blog')
@section('description', 'Read our blog posts to learn more about us and our platform.')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Blog'])

<div class="blog-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center g-4 mb-60">
            @foreach ($posts as $post)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="single-blog-style1 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    <div class="blog-img">
                        <a href="#" class="blog-date"><i class="bi bi-calendar-check"></i>{{ $post->created_at->format('M d, Y') }}</a>
                        <img alt="image" src="{{$post->featured_image_url}}">
                    </div>
                    <div class="blog-content">
                        <h5><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h5>
                        <div class="blog-meta">
                            <div class="author">
                                <img alt="image" src="{{ $post->admin->avatar}}">
                                <a href="{{ route('blog.show', $post->slug) }}" class="author-name">{{ $post->admin->name }}</a>
                            </div>
                            <div class="comment">
                                <img alt="image" src="/assets/images/icons/comment-icon.svg">
                                <a href="#" class="comment">{{ $post->comments->count() }} Comments</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $posts->links('pagination.custom') }}
    </div>
</div>

<x-metric-card />

@endsection