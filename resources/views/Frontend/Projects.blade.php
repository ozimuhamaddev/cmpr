@extends('Frontend/Layout.Main')
@section('Content')
<!--/ Header end -->
<div id="banner-area" class="banner-area" style="background-image:url({{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/banner/banner1.jpg') }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-heading">
                        <h1 class="banner-title">Projects</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ asset(env('APP_URL')) }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ asset(env('APP_URL').'/projects') }}">Projects</a></li>
                            </ol>
                        </nav>
                    </div>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Banner text end -->
</div><!-- Banner area end -->
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

        </div><!-- Content row end -->
    </div>
    <!--/ Container end -->
</section><!-- Project area end -->
@endsection