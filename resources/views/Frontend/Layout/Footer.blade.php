<footer id="footer" class="footer bg-overlay">
    <div class="footer-main">
        <div class="container">
            <div class="row justify-content-between">
                @foreach($data['menu']->data as $menuItem)
                @if($menuItem->menu_id == 8 && $menuItem->active == 'Y')
                <div class="col-lg-4 col-md-6 footer-widget footer-about">
                    <h3 class="widget-title">{{$menuItem->menu_name}}</h3>
                    <img loading="lazy" style="margin-top:-20px;" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/footer-logo.png') }}" alt="PT Cakrawala Synergy Perkasa">
                    <p>{!!$data['aboutus']->data->short_description!!}</p>
                    <!-- <div class="footer-social">
                        <ul>
                            <li><a href="https://facebook.com/themefisher" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://twitter.com/themefisher" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li><a href="https://instagram.com/themefisher" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="https://github.com/themefisher" aria-label="Github"><i class="fab fa-github"></i></a>
                            </li>
                        </ul>
                    </div> -->
                    <!-- Footer social end -->
                </div><!-- Col end -->
                @endif
                @endforeach

                @foreach($data['menu']->data as $menuItem)
                @if($menuItem->menu_id == 15 && $menuItem->active == 'Y')
                <div class="col-lg-4 col-md-6 footer-widget mt-5 mt-md-0">
                    <h3 class="widget-title">{{$menuItem->menu_name}}</h3>
                    <div class="working-hours">

                        @for($a = 0; $a < count($data['others']->data); $a++)
                            @if($data['others']->data[$a]->menu_id == 15)
                            <div class="ts-intro">
                                {!!$data['others']->data[$a]->description!!}
                            </div><!-- Intro box end -->
                            @endif
                            @endfor
                    </div>
                </div><!-- Col end -->
                @endif
                @endforeach

                @foreach($data['menu']->data as $menuItem)
                @if($menuItem->menu_id == 13 && $menuItem->active == 'Y')
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
                    <h3 class="widget-title">{{$menuItem->menu_name}}</h3>
                    <ul class="list-arrow">
                        @for($a = 0; $a < count($data['services']->data); $a++)
                            <li><a href="{{ asset(env('APP_URL').'/services/'.$data['services']->data[$a]->id) }}">{{$data['services']->data[$a]->title}}</a></li>
                            @endfor
                    </ul>
                </div><!-- Col end -->
                @endif
                @endforeach
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Footer main end -->
</footer><!-- Footer end -->

<div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
    <button class="btn btn-primary" title="Back to Top">
        <i class="fa fa-angle-double-up"></i>
    </button>
</div>