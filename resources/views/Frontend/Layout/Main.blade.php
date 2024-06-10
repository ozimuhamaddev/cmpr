<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
================================================== -->
    <meta charset="utf-8">
    <title>PT Cakrawala Synergy Perkasa - Company Profile</title>
    <!-- Mobile Specific Metas
================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Company Profile">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name=author content="Themefisher">
    <meta name=generator content="Themefisher PT Cakrawala Synergy Perkasa HTML Template v1.0">

    <!-- Favicon
================================================== -->
    <link rel="icon" type="image/png" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/favicon.png') }}">

    <!-- CSS
================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/fontawesome/css/all.min.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/animate-css/animate.css') }}">
    <!-- slick Carousel -->
    <link rel="stylesheet" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/slick/slick-theme.css') }}">
    <!-- Colorbox -->
    <link rel="stylesheet" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/colorbox/colorbox.css') }}">
    <!-- Template styles-->
    <link rel="stylesheet" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/css/style.css') }}">

</head>

<body>
    <div class="body-inner">
        <!--/ Topbar end -->
        <!-- Header start -->
        @include('Frontend/Layout.Navigation')
        <!--/ Header end -->
        <!-- Content start -->
        @yield('Content')
        <!--/ Content end -->
        <!-- Footer  -->
        @include('Frontend/Layout.Footer')
        <!-- Footer end -->
        <!-- Javascript Files
  ================================================== -->

        <!-- initialize jQuery Library -->
        <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/jQuery/jquery.min.js') }}"></script>
        <!-- Bootstrap jQuery -->
        <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/bootstrap/bootstrap.min.js') }}" defer></script>
        <!-- Slick Carousel -->
        <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/slick/slick.min.js') }}"></script>
        <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/slick/slick-animation.min.js') }}"></script>
        <!-- Color box -->
        <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/colorbox/jquery.colorbox.js') }}"></script>
        <!-- shuffle -->
        <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/shuffle/shuffle.min.js') }}" defer></script>
        <!-- Google Map API Key-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
        <!-- Google Map Plugin-->
        <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/google-map/map.js') }}" defer></script>

        <!-- Template custom -->
        <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/js/script.js') }}"></script>

    </div><!-- Body inner end -->
</body>

</html>