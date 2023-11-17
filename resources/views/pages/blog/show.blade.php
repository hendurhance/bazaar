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
                        <li><a href="#"><img alt="image" src="/assets/images/icons/calendar.svg">Date: {{ $post->created_at->format('d M Y') }}</a></li>
                        </li>
                        <li><a href="#"><img alt="image" src="/assets/images/icons/tags.svg">Auction</a></li>
                        <li><a href="#"><img alt="image" src="/assets/images/icons/admin.svg">Posted by {{ $post->admin->name }}</a></li>
                    </ul>
                    <h3 class="blog-title">{{ $post->title }}</h3>
                    <div class="blog-content">
                        {!! $post->content !!}
                            banh. Distillery ramps af, goch ujang hell of VHS kitsch austin. Vegan air plant trust fund,
                            poke sartorial ennui next lev el photo booth coloring book etsy green juice meditation
                            austin craft beer.</p>
                    </div>
                    <div class="blog-tag">
                        <div class="row g-3">
                            <div
                                class="col-md-6 d-flex justify-content-md-start justify-content-center align-items-center">
                                <h6>Post Tag:</h6>
                                <ul class="tag-list">
                                    <li><a href="#">Network Setup</a></li>
                                    <li><a href="#">Cars</a></li>
                                    <li><a href="#">Technology</a></li>
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
                            <li>
                                <div class="comment-box">
                                    <div class="comment-header d-flex justify-content-between align-items-center">
                                        <div class="author d-flex flex-wrap">
                                            <img alt="image" src="assets/images/blog/comment1.png">
                                            <h5><a href="#">Leslie Waston</a></h5><span class="commnt-date"> April 6,
                                                2022 at 3:54 am</span>
                                        </div>
                                        <a href="#" class="commnt-reply"><i class="bi bi-reply"></i></a>
                                    </div>
                                    <div class="comment-body">
                                        <p class="para">Aenean dolor massa, rhoncus ut tortor in, pretium tempus neque.
                                            Vestibulum venenati leo et dic tum finibus. Nulla vulputate dolor sit amet
                                            tristique dapibus.Gochujang ugh viral, butcher pabst put a bird on it
                                            meditation austin.</p>
                                    </div>
                                </div>
                                <ul class="comment-reply">
                                    <li>
                                        <div class="comment-box">
                                            <div
                                                class="comment-header d-flex justify-content-between align-items-center">
                                                <div class="author d-flex flex-wrap">
                                                    <img alt="image" src="assets/images/blog/comment2.png">
                                                    <h5><a href="#">Robert Fox</a></h5><span class="commnt-date"> April
                                                        6, 2022 at 3:54 am</span>
                                                </div>
                                                <a href="#" class="commnt-reply"><i class="bi bi-reply"></i></a>
                                            </div>
                                            <div class="comment-body">
                                                <p class="para">Aenean dolor massa, rhoncus ut tortor in, pretium tempus
                                                    neque. Vestibulum venenati leo et dic tum finibus. Nulla vulputate
                                                    dolor sit amet tristique dapibus.Gochujang ugh viral, butcher pabst
                                                    put a bird on it meditation austin.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="comment-box">
                                    <div class="comment-header d-flex justify-content-between align-items-center">
                                        <div class="author d-flex flex-wrap">
                                            <img alt="image" src="assets/images/blog/comment3.png">
                                            <h5><a href="#">William Harvey</a></h5><span class="commnt-date"> April 6,
                                                2022 at 3:54 am</span>
                                        </div>
                                        <a href="#" class="commnt-reply"><i class="bi bi-reply"></i></a>
                                    </div>
                                    <div class="comment-body">
                                        <p class="para">Aenean dolor massa, rhoncus ut tortor in, pretium tempus neque.
                                            Vestibulum venenati leo et dic tum finibus. Nulla vulputate dolor sit amet
                                            tristique dapibus.Gochujang ugh viral, butcher pabst put a bird on it
                                            meditation austin.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="comment-form">
                        <div class="blog-widget-title style2">
                            <h4>Leave A Comment</h4>
                            <p class="para">Your email address will not be published.</p>
                            <span></span>
                        </div>
                        <form action="#">
                            <div class="row">
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <input type="text" placeholder="Your Name :">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <input type="email" placeholder="Your Email :">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-inner">
                                        <textarea name="message" placeholder="Write Message :" rows="12"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="eg-btn btn--primary btn--md form--btn">Submit
                                        Now</button>
                                </div>
                            </div>
                        </form>
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
                                <form>
                                    <div class="form-inner">
                                        <input type="text" placeholder="Search Here">
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
                                <h4>Recent Post</h4>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="recent-post">
                                    @foreach ($post->relatedPosts()->get() as $relatedPost)
                                    <li class="single-post">
                                        <div class="post-img">
                                            <a href="{{ route('blog.show', $relatedPost->slug) }}"><img alt="image" src="{{ $relatedPost->featured_image_url }}"></a>
                                        </div>
                                        <div class="post-content">
                                            <span>{{ $relatedPost->created_at->format('d M Y') }}</span>
                                            <h6><a href="{{ route('blog.show', $relatedPost->slug) }}">{{ $relatedPost->title }}</a></h6>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="blog-widget-item wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".4s"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <div class="top-blog">
                            <div class="sidebar-widget-title">
                                <h4>Post Categories</h4>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="category-list">
                                    <li><a href="#"><span>New Technology</span><span>01</span></a></li>
                                    <li><a href="#"><span>Network Setup</span><span>12</span></a></li>
                                    <li><a href="#"><span>Audi Car Bidding </span><span>33</span></a></li>
                                    <li><a href="#"><span>Entertainment</span><span>54</span></a></li>
                                    <li><a href="#"><span>New Technology</span><span>24</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
                            {{-- <a href="{{ route('auction-details') }}" class="eg-btn btn--primary card--btn">Details</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@endsection