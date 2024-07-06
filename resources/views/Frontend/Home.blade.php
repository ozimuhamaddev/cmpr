@extends('Frontend/Layout.Main')
@section('Content')

<style>
    .latest-post-media {
        width: 350px;
        height: 210px; /* Set a fixed height */
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .latest-post-media img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Preserve the aspect ratio */
    }
    
    .clients-logo {
        width: 300px;
        height: 105px; /* Set a fixed height */
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .clients-logo img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Preserve the aspect ratio */
    }

 

</style>
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

@foreach($menu->data as $menuItem)
@if($menuItem->menu_id == 21 && $menuItem->active == 'Y')
<section class="call-to-action-box no-padding">
    <div class="container">
        <div class="action-style-box">
            <div class="row align-items-center">
                @for($a = 0; $a < count($others->data); $a++)
                @if($others->data[$a]->menu_id == 21)
                <div class="col-md-8 text-center text-md-left">
                    <div class="call-to-action-text">
                        <h3 class="action-title">{!!$others->data[$a]->title!!}</h3>
                    </div>
                </div><!-- Col end -->
                @endif
                @endfor
                <div class="col-md-4 text-center text-md-right mt-3 mt-md-0">
                    <div class="call-to-action-btn">
                        <a class="btn btn-dark" href="https://wa.me/"{{str_replace('08','628', $contact->data->phone)}}><i class="fa fa-paper-plane" aria-hidden="true"> Click Me</i>                        </a>
                    </div>
                </div><!-- col end -->
            </div><!-- row end -->
        </div><!-- Action style box -->
    </div><!-- Container end -->
</section><!-- Action end -->
@endif
@endforeach

<section id="ts-features" class="ts-features">
    <div class="container">
        <div class="row">
            @for($a = 0; $a < count($others->data); $a++)
                @if($others->data[$a]->menu_id == 2)
                <div class="col-12">
                    {!!$others->data[$a]->description!!}
                </div><!-- Intro box end -->
                @endif
                @endfor
        </div><!-- Row end -->
    </div><!-- Container end -->
</section><!-- Feature are end -->

@foreach($menu->data as $menuItem)
@if($menuItem->menu_id == 13 && $menuItem->active == 'Y')
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
                                <h3 class="service-box-title"><a href="{{ asset(env('APP_URL').'/services/'.$services->data[$a]->id) }}">{{$services->data[$a]->title}}</a></h3>
                                <p>{!!$services->data[$a]->short_description!!}</p>
                                <a class="learn-more d-inline-block" href="{{ asset(env('APP_URL').'/services/'.$services->data[$a]->id) }}" aria-label="service-details"><i class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                @endfor
        </div><!-- Content row end -->
    </div><!-- Container end -->
</section><!-- Feature are end -->
@endif
@endforeach

@foreach($menu->data as $menuItem)
@if($menuItem->menu_id == 1 && $menuItem->active == 'Y')
<section id="facts" class="facts-area dark-bg">
    <div class="container">
        <div class="facts-wrapper">
            <div class="row">
                @for($a = 0; $a < count($numberclient->data); $a++)
                    <div class="col-md-3 col-sm-6 ts-facts">
                        <div class="ts-facts-img">
                            <img loading="lazy" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/icon-image/'.$numberclient->data[$a]->icon_image) }}" alt="{{$numberclient->data[$a]->icon_image}}">
                        </div>
                        <div class="ts-facts-content">
                            <h2 class="ts-facts-num"><span class="counterUp" data-count="{!!$numberclient->data[$a]->short_description!!}">0</span></h2>
                            <h3 class="ts-facts-title">{{$numberclient->data[$a]->title}}</h3>
                        </div>
                    </div><!-- Col end -->
                    @endfor
            </div> <!-- Facts end -->
        </div>
        <!--/ Content row end -->
    </div>
    <!--/ Container end -->
</section><!-- Facts end -->
@endif
@endforeach


@foreach($menu->data as $menuItem)
@if($menuItem->menu_id == 5 && $menuItem->active == 'Y')
<section id="ts-service-area" class="ts-service-area pb-0">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <!-- <h2 class="section-title">We Are Specialists In</h2> -->
                <h3 class="section-sub-title">{{$menuItem->menu_name}}</h3>
            </div>
        </div>
        <!--/ Title row end -->
        <div class="row">
            @php
            $count = 0; // Variabel untuk menghitung iterasi
            @endphp

            @foreach($wedo->data as $key => $item)
            @if($count % 3 == 0) <!-- Membuka div baru setiap 3 iterasi -->
            <div class="col-lg-4">
                @endif

                <div class="ts-service-box d-flex">
                    <div class="ts-service-box-img">
                        <img loading="lazy" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/icon-image/service-icon1.png') }}" alt="service-icon">
                    </div>
                    <div class="ts-service-box-info">
                        <h3 class="service-box-title"><a href="#">{{ $item->title }}</a></h3>
                        {!! $item->short_description !!}
                    </div>
                </div><!-- Service 1 end -->

                @php
                $count++; // Increment count after each item
                @endphp

                @if($count % 3 == 0) <!-- Menutup div setiap 3 iterasi -->
            </div><!-- Col end -->
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
@endif
@endforeach


@foreach($menu->data as $menuItem)
@if($menuItem->menu_id == 12 && $menuItem->active == 'Y')
<section id="project-area" class="project-area solid-bg">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">
                <!-- <h2 class="section-title">Work of Excellence</h2> -->
                <h3 class="section-sub-title">{{$menuItem->menu_name}}</h3>
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
                                        <p class="project-cat">{{$projects->data[$a]->proj_category_name}}, {!! $projects->data[$a]->short_description !!}</p>
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
@endif
@endforeach

<section class="content">
    <div class="container">
        <div class="row">
            @php $menu6Found = false; @endphp
            @foreach($menu->data as $menuItem)
            @if($menuItem->menu_id == 6 && $menuItem->active == 'Y')
            <div class="col-lg-6">
                <h3 class="section-sub-title text-center">{{$menuItem->menu_name}}</h3>
                <div id="testimonial-slide" class="testimonial-slide">
                    @php $menu6Found = true; @endphp
                    @foreach($others->data as $other)
                    <div class="item">
                        <div class="quote-item">
                            <span class="quote-text">
                                {!! $other->description !!}
                            </span>
                            <div class="quote-item-footer">
                                <img loading="lazy" class="testimonial-thumb" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/clients/'.$other->image) }}" alt="{{$other->image_ori}}">
                                <div class="quote-item-info">
                                    <h3 class="quote-author">{{$other->title}}</h3>
                                    <span class="quote-subtext">{!!$other->short_description!!}</span>
                                </div>
                            </div>
                        </div><!-- Quote item end -->
                    </div>
                    @endforeach
                </div><!-- Testimonial carousel end -->
            </div><!-- Col end -->
            @endif
            @endforeach

            @if(!$menu6Found)
            <div class="col-lg-12">
                @endif

                @foreach($menu->data as $menuItem)
                @if($menuItem->menu_id == 7 && $menuItem->active == 'Y')
                @if(!$menu6Found)
                <div class="col-lg-12">
                    @else
                    <div class="col-lg-6">
                        @endif
                        <h3 class="section-sub-title text-center">{{$menuItem->menu_name}}</h3>
                        <div class="row all-clients">
                            @foreach($clients->data as $other)
                            <div class="col-sm-4 col-6">
                                <figure class="clients-logo">
                                    <a href="#!"><img loading="lazy" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/clients/'.$other->image) }}" alt="{{$other->image_ori}}" /></a>
                                </figure>
                            </div><!-- Client end -->
                            @endforeach
                        </div><!-- Clients row end -->
                    </div><!-- Col end -->
                    @endif
                    @endforeach

                    @if(!$menu6Found)
                </div><!-- Col end -->
                @endif

            </div><!-- Row end -->
        </div><!-- Container end -->
</section>
<!-- Content end -->

@foreach($menu->data as $menuItem)
@if($menuItem->menu_id == 11 && $menuItem->active == 'Y')
<section id="news" class="news solid-bg">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h3 class="section-sub-title">{{$menuItem->menu_name}}</h3>
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
@endif
@endforeach
<!--/ News end -->
@endsection