@extends('partials.app')
@section('title', 'Blog')
@section('description', 'Read our blog posts to learn more about us and our platform.')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Blog'])

<div class="blog-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center g-4 mb-60">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="single-blog-style1 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    <div class="blog-img">
                        <a href="#" class="blog-date"><i class="bi bi-calendar-check"></i>Jan 30, 2022</a>
                        <img alt="image" src="assets/images/blog/blogstyle11.png">
                    </div>
                    <div class="blog-content">
                        <h5><a href="{{ route('blog-details') }}">Still Has in Advertising Creative
                                Digital Reviews</a></h5>
                        <div class="blog-meta">
                            <div class="author">
                                <img alt="image" src="assets/images/blog/author1.png">
                                <a href="{{ route('blog-details') }}" class="author-name">Johan Martin</a>
                            </div>
                            <div class="comment">
                                <img alt="image" src="assets/images/icons/comment-icon.svg">
                                <a href="#" class="comment">05 Comments</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="single-blog-style1 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".4s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInDown;">
                    <div class="blog-img">
                        <a href="#" class="blog-date"><i class="bi bi-calendar-check"></i>May 30, 2022</a>
                        <img alt="image" src="assets/images/blog/blogstyle12.png">
                    </div>
                    <div class="blog-content">
                        <h5><a href="{{ route('blog-details') }}">Our friend Johnny No-Job He’s a
                                specialist in influencer.</a></h5>
                        <div class="blog-meta">
                            <div class="author">
                                <img alt="image" src="assets/images/blog/author1.png">
                                <a href="{{ route('blog-details') }}" class="author-name">Johan Martin</a>
                            </div>
                            <div class="comment">
                                <img alt="image" src="assets/images/icons/comment-icon.svg">
                                <a href="#" class="comment">05 Comments</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="single-blog-style1 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".4s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInDown;">
                    <div class="blog-img">
                        <a href="#" class="blog-date"><i class="bi bi-calendar-check"></i>Jan 30, 2022</a>
                        <img alt="image" src="assets/images/blog/blogstyle13.png">
                    </div>
                    <div class="blog-content">
                        <h5><a href="{{ route('blog-details') }}">While these are just estimates, they encouraging guide</a></h5>
                        <div class="blog-meta">
                            <div class="author">
                                <img alt="image" src="assets/images/blog/author1.png">
                                <a href="{{ route('blog-details') }}" class="author-name">Johan Martin</a>
                            </div>
                            <div class="comment">
                                <img alt="image" src="assets/images/icons/comment-icon.svg">
                                <a href="#" class="comment">05 Comments</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="single-blog-style1 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".8s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.8s; animation-name: fadeInDown;">
                    <div class="blog-img">
                        <a href="#" class="blog-date"><i class="bi bi-calendar-check"></i>May 30, 2022</a>
                        <img alt="image" src="assets/images/blog/blogstyle14.png">
                    </div>
                    <div class="blog-content">
                        <h5><a href="{{ route('blog-details') }}">What skills do you need marketing consultant?</a></h5>
                        <div class="blog-meta">
                            <div class="author">
                                <img alt="image" src="assets/images/blog/author1.png">
                                <a href="{{ route('blog-details') }}" class="author-name">Johan Martin</a>
                            </div>
                            <div class="comment">
                                <img alt="image" src="assets/images/icons/comment-icon.svg">
                                <a href="#" class="comment">05 Comments</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="single-blog-style1 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="1s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 1s; animation-name: fadeInDown;">
                    <div class="blog-img">
                        <a href="#" class="blog-date"><i class="bi bi-calendar-check"></i>Jan 30, 2022</a>
                        <img alt="image" src="assets/images/blog/blogstyle15.png">
                    </div>
                    <div class="blog-content">
                        <h5><a href="{{ route('blog-details') }}">If you feel the same way becoming a.</a></h5>
                        <div class="blog-meta">
                            <div class="author">
                                <img alt="image" src="assets/images/blog/author1.png">
                                <a href="{{ route('blog-details') }}" class="author-name">Johan Martin</a>
                            </div>
                            <div class="comment">
                                <img alt="image" src="assets/images/icons/comment-icon.svg">
                                <a href="#" class="comment">05 Comments</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="single-blog-style1 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".8s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.8s; animation-name: fadeInDown;">
                    <div class="blog-img">
                        <a href="#" class="blog-date"><i class="bi bi-calendar-check"></i>May 30, 2022</a>
                        <img alt="image" src="assets/images/blog/blogstyle16.png">
                    </div>
                    <div class="blog-content">
                        <h5><a href="{{ route('blog-details') }}">Creative Fashion Riboon Digital with rgb lights.</a></h5>
                        <div class="blog-meta">
                            <div class="author">
                                <img alt="image" src="assets/images/blog/author1.png">
                                <a href="{{ route('blog-details') }}" class="author-name">Johan Martin</a>
                            </div>
                            <div class="comment">
                                <img alt="image" src="assets/images/icons/comment-icon.svg">
                                <a href="#" class="comment">05 Comments</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

<x-metric-card />

@endsection