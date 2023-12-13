<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.seo')
    <link rel="icon" href="assets/images/bg/sm-logo.png" type="image/gif" sizes="20x20">
    @include('layouts.style', ['admin' => false])
</head>

<body>

    @include('layouts.preloader')
    @include('layouts.notify')
    @include('layouts.header', ['admin' => false])
    @include('layouts.search')

    @yield('content')

    @include('layouts.footer')
    @include('layouts.script', ['admin' => false])
</body>

</html>