@extends('partials.app')
@section('title', 'Register')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Register'])

<div class="signup-section pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="form-title">
                        <h3>Sign Up</h3>
                        <p>Do you already have an account? <a href="{{ route('user.login') }}">Log in here</a></p>
                    </div>
                    <form class="w-100" action="{{ route('user.register.handle') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-input-field name="first_name" type="text" label="First Name" placeholder="First Name" />
                            </div>
                            <div class="col-md-6">
                                <x-input-field name="last_name" type="text" label="Last Name" placeholder="Last Name" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="username" type="text" label="Username" placeholder="Enter Your Username" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="email" type="email" label="Enter Your Email" placeholder="Enter Your Email" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="password" type="password" label="Password" placeholder="Create A Password" />
                            </div>
                            <div class="col-md-12">
                                <x-agree-checkbox class="form-agreement form-inner d-flex justify-content-between flex-wrap" id="html" name="terms" label="I agree to the Terms & Policy" />
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

<x-metric-card />

@endsection