<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>e-Wallet</title>
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords"content="bootstrap, wallet, banking, fintech mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="shortcut icon" href="assets/images/logo1.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{  asset("front/assets/img/icon/192x192.png")}}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('front/assets/fontawesome/css/all.css')}}">
</head>

<body>
    <!-- App Header -->
    @include('front.wali.layout.header')

    <!-- * App Header -->

    {{-- konten --}}
    @yield('content')
    {{-- konten --}}

    <!-- App Bottom Menu -->
    @include('front.wali.layout.button')
    <!-- * App Bottom Menu -->
    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="{{ asset('front/assets/js/lib/bootstrap.bundle.min.js')}}"></script>
    <!-- Ionicons -->
    <script type="module" src="../../unpkg.com/ionicons%405.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="{{ asset('front/assets/js/plugins/splide/splide.min.js')}}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/js/base.js')}}"></script>

    <script>
        AddtoHome("2000", "once");

    </script>
    <script>
        setTimeout(function () {
            document.getElementById('loadingImage').style.display = 'none';
            document.getElementById('mainContent').style.display = 'block';
        }, 3000);

    </script>

</body>

</html>
