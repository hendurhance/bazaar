<div class="inner-banner">
    <div class="container">
        <h2 class="inner-banner-title wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s"
            style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInLeft;">
           {{ $pageTitle }} </h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
            </ol>
        </nav>
    </div>
</div>