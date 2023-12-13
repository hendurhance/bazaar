<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @include('layouts.seo')
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico">
    @include('layouts.style', ['admin' => true])
</head>

<body class="app sidebar-mini ltr light-mode">

    @include('layouts.notify')

    <div class="page">
        <div class="page-main">
            @yield('content')
        </div>
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa-regular fa-angle-up"></i></a>

    @include('layouts.script', ['admin' => true])
</body>

</html>