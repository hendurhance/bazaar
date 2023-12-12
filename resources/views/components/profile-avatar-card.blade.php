<div class="dropdown d-flex profile-1">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex" aria-expanded="false">
        <img src="{{$admin->avatar}}" alt="profile-user" class="avatar  profile-user brround cover-image">
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <div class="drop-heading">
            <div class="text-center">
                <h5 class="text-dark mb-0 fs-14 fw-semibold">{{$admin->name}}</h5>
                <small class="text-muted">{{'@'.$admin->username}}</small>
            </div>
        </div>
        <div class="dropdown-divider m-0"></div>
    <a class="dropdown-item" href="{{ route('admin.profile') }}">
            <i class="dropdown-icon fa-light fa-user"></i> Profile
        </a>
        <form class="dropdown-item" action="{{ route('admin.logout.handle') }}" method="POST">
            @csrf
            <button class="no-bg-bdr" type="submit"><i class="dropdown-icon fa-light fa-circle-exclamation"></i> Sign out</button>
        </form>
    </div>
</div>