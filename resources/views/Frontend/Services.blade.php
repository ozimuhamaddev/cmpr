@extends('Frontend/Layout.Main')
@section('Content')
<!--/ Header end -->
<div id="banner-area" class="banner-area" style="background-image:url({{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/banner/banner1.jpg') }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-heading">
                        <h1 class="banner-title">Services</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ asset(env('APP_URL')) }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ asset(env('APP_URL').'/services') }}">Services</a></li>
                            </ol>
                        </nav>
                    </div>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Banner text end -->
</div><!-- Banner area end -->
<section id="main-container" class="main-container pb-2">
    <div class="container">
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
        </div><!-- Main row end -->
    </div><!-- Conatiner end -->
</section><!-- Main container end -->
@endsection