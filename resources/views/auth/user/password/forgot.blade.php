@extends('partials.app')
@section('title', 'Forgot Password')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Forgot Password'])

<div class="login-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center g-4">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="form-title">
                        <h3>Fogot Password</h3>
                        <p>Write your email address below and we will send you password reset instructions.</p>
                    </div>
                    <form class="w-100" action="{{ route('user.forgot-password.handle') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <x-input-field name="email" type="email" label="Enter Your Email" placeholder="Enter Your Email" />
                            </div>
                        </div>
                        <button class="account-btn">Send Reset Link</button>
                    </form>
                    <div class="form-poicy-area">
                        <p>By clicking the "send reset link" button, you create a Bazaar account, and you agree to Bazaar's <a
                                href="#">Terms &amp; Conditions</a> &amp; <a href="#">Privacy Policy.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@endsection