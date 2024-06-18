@extends('Frontend/Layout.Main')
@section('Content')
<section id="main-container" class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="column-title">{{$aboutus->data->title}}</h3>
                {{$aboutus->data->description}}
            </div><!-- Col end -->

            <div class="col-lg-6 mt-5 mt-lg-0">

                <div id="page-slider" class="page-slider small-bg">

                    <div class="item" style="background-image:url({{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/slider-pages/'.$aboutus->data->image) }})">
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