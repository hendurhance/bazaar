@extends('partials.app')
@section('title', 'About')
@section('description', 'Learn more about how we work and what we do.')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'About'])

<div class="about-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center g-4">
            <div class="col-lg-6 col-md-10">
                <div class="about-img-area">
                    <div class="total-tag">
                        <img src="assets/images/bg/total-tag.png" alt="">
                        <h6>Total Raised</h6>
                        <h5>$45,390.00</h5>
                    </div>
                    <img src="assets/images/bg/about-img.png" class="img-fluid about-img wow fadeInUp"
                        data-wow-duration="1.5s" data-wow-delay=".2s" alt="about-img"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <img src="assets/images/bg/about-linear.png" class="img-fluid about-linear" alt="">
                    <img src="assets/images/bg/about-vector.png" class="img-fluid about-vector" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-10">
                <div class="about-content wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    <span>Who we are!</span>
                    <h2>We Work for Your Incredible Success</h2>
                    <p class="para">Auction sites present consumers with a thrilling, competitive way to buy the goods
                        and services they need most.</p>
                    <p class="para">But getting your own auction site up and running has always required learning
                        complex coding languages, or hiring an expensive design firm for thousands of dollars and months
                        of work.</p>
                    <ul class="about-list">
                        <li><a href="#">Have enough food for life.</a></li>
                        <li><a href="#">Poor children can return to school.</a></li>
                        <li><a href="#">Fuga magni veritatis ad temporibus atque adipisci nisi rerum...</a></li>
                    </ul>
                    <a href="#choose-us" class="eg-btn btn--primary btn--md">More About</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.why-choose-us')

@include('layouts.testimonials')

<x-metric-card />

@endsection