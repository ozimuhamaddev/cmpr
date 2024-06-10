<header id="header" class="header-one">
    <div class="site-navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-dark p-0">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div id="navbar-collapse" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav mr-auto">
                                @php
                                $home ="";
                                $about ="";
                                $projects ="";
                                $services ="";
                                $news ="";
                                $contact ="";

                                if($menu =="home"){
                                $home ="active";
                                }

                                if($menu =="about"){
                                $about ="active";
                                }

                                if($menu =="projects"){
                                $projects ="active";
                                }

                                if($menu =="services"){
                                $services ="active";
                                }

                                if($menu =="news"){
                                $news ="active";
                                }

                                if($menu =="contact"){
                                $contact ="active";
                                }
                                @endphp
                                <li class="nav-item {{$home}}"><a class="nav-link" href="{{ asset(env('APP_URL')) }}">Home</a></li>
                                <li class="nav-item {{$about}}"><a class="nav-link" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/about') }}">About Us</a></li>
                                <li class="nav-item {{$projects}}"><a class="nav-link" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/projects') }}">Projects</a></li>
                                <li class="nav-item {{$services}}"><a class="nav-link" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/services') }}">Services</a></li>
                                <li class="nav-item {{$news}}"><a class="nav-link" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/news') }}">News</a></li>
                                <li class="nav-item {{$contact}}"><a class="nav-link" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!--/ Col end -->
            </div>
            <!--/ Row end -->

            <div class="nav-search">
                <img loading="lazy" style="margin-top:-20px;" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/footer-logo.png') }}" alt="PT Cakrawala Synergy Perkasa">
            </div><!-- Search end -->
        </div>
        <!--/ Container end -->

    </div>
    <!--/ Navigation end -->
</header>