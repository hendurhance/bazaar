@extends('partials.admin')
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
                    <form class="login100-form validate-form">
                        <span class="login100-form-title pb-5">
                            Admin Forgot Password
                        </span>
                        <div class="panel panel-primary">
                            <div class="panel-body tabs-menu-body p-0 pt-5">
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="fa-solid fa-envelope"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" type="email" placeholder="Email">
                                        </div>
                                        <span>Note: By requesting, you agree to the <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></span>
                                        <div class="container-login100-form-btn ">
                                            <a class="login100-form-btn btn-primary">
                                                Send Password Reset Link
                                            </a>
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