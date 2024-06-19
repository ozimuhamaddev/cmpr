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
<section id="main-container" class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="column-title">{{$services->data->title}}</h3>
                {{$services->data->description}}
            </div><!-- Col end -->

            <div class="col-lg-6 mt-5 mt-lg-0">

                <div id="page-slider" class="page-slider small-bg">

                    <div class="item" style="background-image:url({{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/services/'.$services->data->image) }})">
                        <!-- <div class="container">
                            <div class="box-slider-content">
                                <div class="box-slider-text">
                                    <h2 class="box-slide-title">Leadership</h2>
                                </div>
                            </div>
                        </div> -->
                    </div><!-- Item 1 end -->
                </div><!-- Page slider end-->


            </div><!-- Col end -->
        </div><!-- Content row end -->

    </div><!-- Container end -->
</section><!-- Main container end -->
@endsection