@extends('partials.app')
@section('title', 'Reset Password')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Reset Password'])

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
                    <form class="w-100">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-inner">
                                    <label>New Password *</label>
                                    <input type="password" name="password" id="password" placeholder="Password">
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-inner">
                                    <label>Confirm Password *</label>
                                    <input type="password" name="password" id="password" placeholder="Password">
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </div>
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

@include('layouts.metrics')

@endsection