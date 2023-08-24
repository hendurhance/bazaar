@extends('partials.app')
@section('title', 'Register')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Register'])

<div class="signup-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="form-title">
                        <h3>Sign Up</h3>
                        <p>Do you already have an account? <a href="login.html">Log in here</a></p>
                    </div>
                    <form class="w-100">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-inner">
                                    <label>Frist Name *</label>
                                    <input type="email" placeholder="Frist Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-inner">
                                    <label>Last Name *</label>
                                    <input type="email" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-inner">
                                    <label>Username *</label>
                                    <input type="username" placeholder="Enter Your Username">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-inner">
                                    <label>Enter Your Email *</label>
                                    <input type="email" placeholder="Enter Your Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-inner">
                                    <label>Password *</label>
                                    <input type="password" name="password" id="password"
                                        placeholder="Create A Password">
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                                    <div class="form-group">
                                        <input type="checkbox" id="html">
                                        <label for="html">I agree to the Terms &amp; Policy</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="account-btn">Create Account</button>
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