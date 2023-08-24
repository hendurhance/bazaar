@extends('partials.app')
@section('title', 'Login')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Login'])

<div class="login-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center g-4">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="form-title">
                        <h3>Log In</h3>
                        <p>New Member? <a href="signup.html">signup here</a></p>
                    </div>
                    <form class="w-100">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-inner">
                                    <label>Enter Your Email *</label>
                                    <input type="email" placeholder="Enter Your Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-inner">
                                    <label>Password *</label>
                                    <input type="password" name="password" id="password" placeholder="Password">
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                                    <div class="form-group">
                                        <input type="checkbox" id="html">
                                        <label for="html">I agree to the <a href="#">Terms &amp; Policy</a></label>
                                    </div>
                                    <a href="#" class="forgot-pass">Forgotten Password</a>
                                </div>
                            </div>
                        </div>
                        <button class="account-btn">Log in</button>
                    </form>
                    <div class="form-poicy-area">
                        <p>By clicking the "signup" button, you create a Bazaar account, and you agree to Bazaar's <a
                                href="#">Terms &amp; Conditions</a> &amp; <a href="#">Privacy Policy.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.metrics')

@endsection