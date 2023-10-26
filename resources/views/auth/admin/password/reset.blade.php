@extends('partials.admin')
@section('title', 'Admin Reset Password')
@section('content')

<div class="bg-admin">
    <div class="page">
        <div>
            <div class="col col-login mx-auto mt-7">
                <div class="text-center">
                    <a href="index.html"><img src="/assets/images/bg/header-logo2.png" class="header-brand-img" alt=""></a>
                </div>
            </div>
            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <form class="login100-form validate-form" method="POST" action="{{ route('admin.reset-password.handle') }}">
                        @csrf
                        <span class="login100-form-title pb-5">
                            Reset Password
                        </span>
                        <div class="panel panel-primary">
                            <div class="panel-body tabs-menu-body p-0 pt-5">
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                    <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" type="password" name="password" placeholder="New Password">
                                        </div>
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" type="password" name="password_confirmation" placeholder="Confirm Password">
                                        </div>
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span><br>
                                        <span>Note: By resetting, you agree to the <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></span>
                                        <div class="container-login100-form-btn ">
                                            <button type="submit" class="login100-form-btn btn-primary">
                                                Reset Password
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection