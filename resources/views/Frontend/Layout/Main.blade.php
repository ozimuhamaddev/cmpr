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
    <meta name="description" content="Learn about PT Cakrawala Synergy Perkasa, our mission, values, and the services we provide.">
    <meta name="keywords" content="PT Cakrawala Synergy Perkasa, company profile, services, mission, values,listrik, electricity">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name=author content="Themefisher">
    <meta name=generator content="PT Cakrawala Synergy Perkasa">

    <!-- Favicon
================================================== -->
    <link rel="icon" type="image/png" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/footer-logo.png') }}">

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



    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="PT Cakrawala Synergy Perkasa - Company Profile">
    <meta property="og:description" content="Learn about PT Cakrawala Synergy Perkasa, our mission, values, and the services we provide.">
    <meta property="og:image" content="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/footer-logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Robots Meta Tag -->
    <meta name="robots" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

</head>

<body>
    <div class="body-inner">
        <!--/ Topbar end -->
        <!-- Header start -->
        @include('Frontend/Layout.Navigation', ['data' => App\Http\Controllers\Frontend\Main::getNavigatorData(request())])
        <!--/ Header end -->
        <!-- Content start -->
        @yield('Content')
        <!--/ Content end -->
        <!-- Footer  -->
        @include('Frontend/Layout.Footer', ['data' => App\Http\Controllers\Frontend\Main::getFooterData(request())])
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

        @yield('Scripts')


        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "Organization",
                "name": "PT Cakrawala Synergy Perkasa",
                "url": "{{ url()->current() }}",
                "logo": "{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/footer-logo.png') }}",
              
            }
        </script>

    </div><!-- Body inner end -->
</body>

</html>