<header class="style-2">
    <div class="header-logo">
        <a href="{{ route('index') }}"><img alt="image" src="/assets/images/bg/header-logo2.png"></a>
    </div>
    <div class="main-menu">
        <div class="mobile-logo-area d-lg-none d-flex justify-content-between align-items-center">
            <div class="mobile-logo-wrap">
                <a href="{{ route('index') }}"><img alt="image" src="/assets/images/bg/header-logo2.png"></a>
            </div>
            <div class="menu-close-btn">
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
        <ul class="menu-list">
            <li>
                <a href="{{ route('index') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('how-it-works') }}">How It Works</a>
            </li>
            <li>
                <a href="{{ route('live-auction') }}">Live Auction</a>
            </li>
            <li class="menu-item-has-children">
                <a href="#">Company</a><i class="bx bx-plus dropdown-icon"></i>
                <ul class="submenu">
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('blog') }}">Blog</a>
            </li>
        </ul>

        <div class="d-lg-none d-block">
            <form class="mobile-menu-form style-2 mb-5">
                <div class="input-with-btn d-flex flex-column">
                    <input type="text" placeholder="Search here...">
                    <button type="submit" class="eg-btn btn--primary2 btn--sm">Search</button>
                </div>
            </form>
            <div class="hotline two">
                <div class="hotline-info">
                    <span>Click To Call</span>
                    <h6><a href="tel:347-274-8816">+347-274-8816</a></h6>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-right d-flex align-items-center">
        <div class="search-btn">
            <i class="bi bi-search"></i>
        </div>
        <a href="{{ route('add-listing') }}" class="join-btn">Add Listing</a>
        @guest('web')
        <a href="{{ route('user.login') }}" class="join-btn">Login</a>
        @endguest
        <div class="eg-btn btn--primary2 header-btn">
            @guest('web')
            <a href="{{ route('user.login') }}">Register</a>
            @endguest
            @auth('web')
            <a href="{{ route('user.dashboard') }}">My Account</a>
            @endauth
        </div>
        <div class="mobile-menu-btn d-lg-none d-block">
            <i class="bx bx-menu"></i>
        </div>
    </div>
</header>