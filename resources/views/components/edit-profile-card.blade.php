<div class="row">
    <div class="col-xl-4">
        <form class="card" action="{{route('admin.profile.change-password.handle')}}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-header">
                <div class="card-title">Edit Password</div>
            </div>
            <div class="card-body">
                <div class="text-center chat-image mb-5">
                    <div class="avatar avatar-xxl chat-profile mb-3 brround">
                        <a class="" href="javascript:void(0)"><img alt="avatar" src="{{$admin->avatar}}"
                                class="brround"></a>
                    </div>
                    <div class="main-chat-msg-name">
                        <a href="javascript:void(0)">
                            <h5 class="mb-1 text-dark fw-semibold">{{$admin->name}}</h5>
                        </a>
                        <p class="text-muted mt-0 mb-0 pt-0 fs-13">{{'@'.$admin->username}} </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Current Password</label>
                    <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                            <i class="fa-regular fa-eye text-muted" aria-hidden="true"></i>
                        </a>
                        <input class="input100 form-control" name="current_password" type="password" placeholder="Current Password"
                            autocomplete="current-password">
                    </div>
                    <span class="text-danger">{{$errors->first('current_password')}}</span>
                </div>
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                            <i class="fa-regular fa-eye text-muted" aria-hidden="true"></i>
                        </a>
                        <input class="input100 form-control" name="password" type="password" placeholder="New Password"
                            autocomplete="new-password">
                    </div>
                    <span class="text-danger">{{$errors->first('password')}}</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                            <i class="fa-regular fa-eye text-muted" aria-hidden="true"></i>
                        </a>
                        <input class="input100 form-control" name="password_confirmation" type="password" placeholder="Confirm Password"
                            autocomplete="new-password">
                    </div>
                    <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{route('admin.dashboard')}}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
        <div class="card panel-theme">
            <div class="card-header">
                <div class="float-start">
                    <h3 class="card-title">Contact</h3>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-body no-padding">
                <ul class="list-group no-margin">
                    <li class="list-group-item d-flex ps-3">
                        <div class="social social-profile-buttons me-2">
                            <a class="social-icon text-primary" href="javascript:void(0)"><i class="fa-regular fa-envelope"></i></a>
                        </div>
                        <a href="mailto:{{$admin->email}}" class="my-auto">{{$admin->email}}</a>
                    </li>
                    <li class="list-group-item d-flex ps-3">
                        <div class="social social-profile-buttons me-2">
                            <a class="social-icon text-primary" href="javascript:void(0)"><i class="fa-regular fa-phone"></i></a>
                        </div>
                        <a href="tel:{{$admin->mobile}}" class="my-auto">{{$admin->mobile}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <form class="card" action="{{route('admin.profile.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h3 class="card-title">Edit Profile</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="exampleInputname">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="exampleInputname"
                                placeholder="First Name" value="{{$admin->first_name}}">
                            <span class="text-danger">{{$errors->first('first_name')}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="exampleInputname1">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="exampleInputname1"
                                placeholder="Enter Last Name" value="{{$admin->last_name}}">
                        </div>
                        <span class="text-danger">{{$errors->first('first_name')}}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1"
                        placeholder="Email address" value="{{$admin->email}}" readonly disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputnumber">Contact Number</label>
                    <input type="text" class="form-control" id="exampleInputnumber"
                        placeholder="Contact number" value="{{$admin->mobile}}" readonly disabled>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success my-1">Save</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-danger my-1">Cancel</a>
            </div>
        </form>
    </div>
</div>