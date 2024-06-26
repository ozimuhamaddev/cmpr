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
                                @foreach ($menu as $item)
                                <li class="nav-item {{ $item['active'] }}"><a class="nav-link" href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
                                @endforeach

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