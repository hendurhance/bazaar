@extends('partials.app')
@section('title', 'Reset Password')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Reset Password'])

<div class="login-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center g-4">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="form-title">
                        <h3>Reset Password</h3>
                        <p>Fill in the form below to reset your password.</p>
                    </div>
                    <form class="w-100" action="{{ route('user.reset-password.handle') }}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="col-12">
                                <x-input-field name="password" type="password" label="New Password" placeholder="Create A New Password" />
                            </div>
                            <div class="col-12">
                                <x-input-field name="password_confirmation" type="password" label="Confirm Password" placeholder="Confirm Password" />
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