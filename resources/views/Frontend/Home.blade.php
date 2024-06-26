@extends('Frontend/Layout.Main')
@section('Content')


<div class="banner-carousel banner-carousel-1 mb-0">


    @for($a = 0; $a < count($banner->data); $a++)
        <div class="banner-carousel-item" style="background-image:url({{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/slider-main/'.$banner->data[$a]->image) }})">
            <div class="slider-content">
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-md-12 text-center">
                            <h2 class="slide-title" data-animation-in="slideInLeft">{{$banner->data[$a]->sub_title}}</h2>
                            <h3 class="slide-sub-title" data-animation-in="slideInRight">{{$banner->data[$a]->title}}</h3>
                            <!-- <p data-animation-in="slideInLeft" data-duration-in="1.2">
                                <a href="services.html" class="slider btn btn-primary">Our Services</a>
                                <a href="contact.html" class="slider btn btn-primary border">Contact Now</a>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor
</div>

<section class="call-to-action-box no-padding">
    <div class="container">
        <div class="action-style-box">
            <div class="row align-items-center">
                <div class="col-md-8 text-center text-md-left">
                    <div class="call-to-action-text">
                        <h3 class="action-title">We understand your needs on construction</h3>
                    </div>
                </div><!-- Col end -->
                <div class="col-md-4 text-center text-md-right mt-3 mt-md-0">
                    <div class="call-to-action-btn">
                        <a class="btn btn-dark" href="#">Request Quote</a>
                    </div>
                </div><!-- col end -->
            </div><!-- row end -->
        </div><!-- Action style box -->
    </div><!-- Container end -->
</section><!-- Action end -->

<section id="ts-features" class="ts-features">
    <div class="container">
        <div class="row">
            @for($a = 0; $a < count($others->data); $a++)
                @if($others->data[$a]->menu_id == 2)
                <div class="col-lg-6">
                    <div class="ts-intro">
                        <h3 class="into-sub-title">{{$others->data[$a]->title}}</h3>
                        {{$others->data[$a]->short_description}}
                    </div><!-- Intro box end -->
                </div><!-- Col end -->
                @endif
                @endfor
                <div class="col-lg-6 mt-4 mt-lg-0">

                    @for($a = 0; $a < count($others->data); $a++)
                        @if($others->data[$a]->menu_id == 3)
                        <h3 class="into-sub-title">{{$others->data[$a]->title}}</h3>
                        {{$others->data[$a]->short_description}}
                        @endif
                        @endfor
                        @for($a = 0; $a < count($others->data); $a++)
                            @if($others->data[$a]->menu_id == 4)
                            <h3 class="into-sub-title">{{$others->data[$a]->title}}</h3>
                            {{$others->data[$a]->short_description}}
                            @endif
                            @endfor

                </div><!-- Col end -->
        </div><!-- Row end -->
    </div><!-- Container end -->
</section><!-- Feature are end -->

<section id="ts-features" class="project-area solid-bg">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h3 class="section-sub-title">OUR SERVICE</h3>
            </div>
        </div>
        <div class="row">
            @for($a = 0; $a < count($services->data); $a++)
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/services/'.$services->data[$a]->image) }}" alt="{{$services->data[$a]->image_ori}}">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-box-img">
                                <img loading="lazy" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/icon-image/'.$services->data[$a]->icon_image) }}" alt="{{$services->data[$a]->icon_image_ori}}" />
                            </div>
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="service-single.html">{{$services->data[$a]->title}}</a></h3>
                                <p>{{$services->data[$a]->short_description}}</p>
                                <a class="learn-more d-inline-block" href="{{ asset(env('APP_URL').'/services/'.$services->data[$a]->id) }}" aria-label="service-details"><i class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                @endfor
        </div><!-- Content row end -->
    </div><!-- Container end -->
</section><!-- Feature are end -->

<section id="facts" class="facts-area dark-bg">
    <div class="container">
        <div class="facts-wrapper">
            <div class="row">
                @for($a = 0; $a < count($others->data); $a++)
                    @if($others->data[$a]->menu_id == 1)
                    <div class="col-md-3 col-sm-6 ts-facts">
                        <div class="ts-facts-img">
                            <img loading="lazy" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/icon-image/'.$others->data[$a]->icon_image) }}" alt="{{$others->data[$a]->icon_image}}">
                        </div>
                        <div class="ts-facts-content">
                            <h2 class="ts-facts-num"><span class="counterUp" data-count="{{$others->data[$a]->short_description}}">0</span></h2>
                            <h3 class="ts-facts-title">{{$others->data[$a]->title}}</h3>
                        </div>
                    </div><!-- Col end -->
                    @endif
                    @endfor
            </div> <!-- Facts end -->
        </div>
        <!--/ Content row end -->
    </div>
    <!--/ Container end -->
</section><!-- Facts end -->

<section id="ts-service-area" class="ts-service-area pb-0">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <!-- <h2 class="section-title">We Are Specialists In</h2> -->
                <h3 class="section-sub-title">What We Do</h3>
            </div>
        </div>
        <!--/ Title row end -->
        <div class="row">
            @php
            $count = 0; // Variabel untuk menghitung iterasi
            @endphp

            @foreach($others->data as $key => $item)
            @if($item->menu_id == 5)
            @if($count % 3 == 0) <!-- Membuka div baru setiap 3 iterasi -->
            <div class="col-lg-4">
                @endif

                <div class="ts-service-box d-flex">
                    <div class="ts-service-box-img">
                        <img loading="lazy" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/icon-image/service-icon1.png') }}" alt="service-icon">
                    </div>
                    <div class="ts-service-box-info">
                        <h3 class="service-box-title"><a href="#">{{ $item->title }}</a></h3>
                        {{ $item->short_description }}
                    </div>
                </div><!-- Service 1 end -->

                @php
                $count++; // Increment count after each item
                @endphp

                @if($count % 3 == 0) <!-- Menutup div setiap 3 iterasi -->
            </div><!-- Col end -->
            @endif
            @endif
            @endforeach

            <!-- Menutup div jika iterasi terakhir tidak menutup div -->
            @if($count % 3 != 0)
        </div><!-- Col end -->
        @endif
        <div class="col-lg-4 text-center">
            <img loading="lazy" class="img-fluid" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/services/service-center.jpg') }}" alt="service-avater-image">
        </div><!-- Col end -->
    </div><!-- Content row end -->

    </div>
    <!--/ Container end -->
</section><!-- Service end -->

<section id="project-area" class="project-area solid-bg">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">
                <!-- <h2 class="section-title">Work of Excellence</h2> -->
                <h3 class="section-sub-title">Recent Projects</h3>
            </div>
        </div>
        <!--/ Title row end -->

        <div class="row">
            <div class="col-12">
                <div class="shuffle-btn-group">
                    <label class="active" for="all">
                        <input type="radio" name="shuffle-filter" id="all" value="all" checked="checked">Show All
                    </label>
                    @for($a = 0; $a < count($projects_category->data); $a++)
                        <label for="{{$projects_category->data[$a]->proj_category_name}}">
                            <input type="radio" name="shuffle-filter" id="{{$projects_category->data[$a]->proj_category_name}}" value="{{$projects_category->data[$a]->proj_category_name}}">{{ucwords($projects_category->data[$a]->proj_category_name)}}
                        </label>
                        @endfor
                </div><!-- project filter end -->


                <div class="row shuffle-wrapper">
                    <div class="col-1 shuffle-sizer"></div>

                    @for($a = 0; $a < count($projects->data); $a++)
                        <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;government&quot;,&quot;{{$projects->data[$a]->proj_category_name}}&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/projects/'.$projects->data[$a]->image) }}" aria-label="{{$projects->data[$a]->image_ori}}">
                                    <img class="img-fluid" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/projects/'.$projects->data[$a]->image) }}" alt="{{$projects->data[$a]->image_ori}}">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="{{ asset(env('APP_URL').'/projects/'.$projects->data[$a]->id) }}">{{$projects->data[$a]->title}}</a>
                                        </h3>
                                        <p class="project-cat">{{$projects->data[$a]->proj_category_name}}, {{$projects->data[$a]->short_description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 1 end -->
                        @endfor
                </div><!-- shuffle end -->
            </div>

            <div class="col-12">
                <div class="general-btn text-center">
                    <a class="btn btn-primary" href="{{ asset(env('APP_URL').'/projects/') }}">View All Projects</a>
                </div>
            </div>

        </div><!-- Content row end -->
    </div>
    <!--/ Container end -->
</section><!-- Project area end -->

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="column-title">Testimonials</h3>
                <div id="testimonial-slide" class="testimonial-slide">
                    @for($a = 0; $a < count($others->data); $a++)
                        @if($others->data[$a]->menu_id == 6)
                        <div class="item">
                            <div class="quote-item">
                                <span class="quote-text">
                                    {{$others->data[$a]->description}}
                                </span>

                                <div class="quote-item-footer">
                                    <img loading="lazy" class="testimonial-thumb" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/clients/'.$others->data[$a]->image) }}" alt="{{$others->data[$a]->image_ori}}">
                                    <div class="quote-item-info">
                                        <h3 class="quote-author">{{$others->data[$a]->title}}</h3>
                                        <span class="quote-subtext">{{$others->data[$a]->short_description}}</span>
                                    </div>
                                </div>
                            </div><!-- Quote item end -->
                        </div>
                        @endif
                        @endfor
                </div>
                <!--/ Testimonial carousel end-->
            </div><!-- Col end -->

            <div class="col-lg-6 mt-5 mt-lg-0">

                <h3 class="column-title">Happy Clients</h3>

                <div class="row all-clients">
                    @for($a = 0; $a < count($others->data); $a++)
                        @if($others->data[$a]->menu_id == 7)
                        <div class="col-sm-4 col-6">
                            <figure class="clients-logo">
                                <a href="#!"><img loading="lazy" class="img-fluid" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/clients/'.$others->data[$a]->image) }}" alt="{{$others->data[$a]->image_ori}}" /></a>
                            </figure>
                        </div><!-- Client 1 end -->
                        @endif
                        @endfor
                </div><!-- Clients row end -->

            </div><!-- Col end -->

        </div>
        <!--/ Content row end -->
    </div>
    <!--/ Container end -->
</section><!-- Content end -->

<section class="subscribe no-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="subscribe-call-to-acton">
                    <h3>Can We Help?</h3>
                    <h4>(+9) 847-291-4353</h4>
                </div>
            </div><!-- Col end -->

            <div class="col-lg-8">
                <div class="ts-newsletter row align-items-center">
                    <div class="col-md-5 newsletter-introtext">
                        <h4 class="text-white mb-0">Newsletter Sign-up</h4>
                        <p class="text-white">Latest updates and news</p>
                    </div>

                    <div class="col-md-7 newsletter-form">
                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="newsletter-email" class="content-hidden">Newsletter Email</label>
                                <input type="email" name="email" id="newsletter-email" class="form-control form-control-lg" placeholder="Your your email and hit enter" autocomplete="off">
                            </div>
                        </form>
                    </div>
                </div><!-- Newsletter end -->
            </div><!-- Col end -->

        </div><!-- Content row end -->
    </div>
    <!--/ Container end -->
</section>
<!--/ subscribe end -->

<section id="news" class="news">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h3 class="section-sub-title">Newsletter</h3>
            </div>
        </div>
        <!--/ Title row end -->

        <div class="row">
            @for($a = 0; $a < count($news->data); $a++)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="latest-post">
                        <div class="latest-post-media">
                            <a href="{{ asset(env('APP_URL').'/news/'.$news->data[$a]->id) }}" class="latest-post-img">
                                <img loading="lazy" class="img-fluid" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/news/'.$news->data[$a]->image) }}" alt="{{$news->data[$a]->image_ori}}">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4 class="post-title">
                                <a href="{{ asset(env('APP_URL').'/news/'.$news->data[$a]->id) }}" class="d-inline-block">{{$news->data[$a]->title}}</a>
                            </h4>
                            <div class="latest-post-meta">
                                <span class="post-item-date">
                                    <i class="fa fa-clock-o"></i> {{$news->data[$a]->created_at}}
                                </span>
                            </div>
                        </div>
                    </div><!-- Latest post end -->
                </div><!-- 1st post col end -->
                @endfor
        </div>
        <!--/ Content row end -->

        <div class="general-btn text-center mt-4">
            <a class="btn btn-primary" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/news') }}">See All Posts</a>
        </div>

    </div>
    <!--/ Container end -->
</section>
<!--/ News end -->
@endsection