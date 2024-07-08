@extends('Frontend/Layout.Main')
@section('Content')
<style>
    .post-image {
        width: 750px;
        /* 30% of the viewport height */
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .post-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<div id="banner-area" class="banner-area" style="background-image:url({{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/banner/banner1.jpg') }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-heading">
                        <h1 class="banner-title">News</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ asset(env('GLOBAL_PLUGIN_PATH')) }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/news') }}">News</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$news->data->getDetail->title}}</li>
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

            <div class="col-lg-8 mb-5 mb-lg-0">

                <div class="post-content post-single">
                    <h2 class="entry-title">
                        {{$news->data->getDetail->title}}
                    </h2>
                    <div class="entry-header">
                        <div class="post-meta">
                            <span class="post-author">
                                <i class="far fa-user"></i><a href="#"> Admin</a>
                            </span>
                            <span class="post-cat">
                                <i class="far fa-folder-open"></i><a href="#"> News</a>
                            </span>
                            <span class="post-comment"><i class="far fa-calendar"></i> {{$news->data->getDetail->created_at}}</span>
                            <!-- <span class="post-comment"><i class="far fa-comment"></i> 03<a href="#" class="comments-link">Comments</a></span> -->
                        </div>
                    </div><!-- header end -->
                    <div class="post-media post-image">
                        <img loading="lazy" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/news/'.$news->data->getDetail->image) }}" class="{{$news->data->getDetail->image}}" alt="post-image">
                    </div>

                    <div class="post-body">
                        <div class="entry-content">
                            {!!$news->data->getDetail->description!!}
                        </div>

                        <div class="tags-area d-flex align-items-center justify-content-between">
                            <div class="post-tags">

                                @php
                                $tags = explode(',',$news->data->getDetail->tag);
                                @endphp
                                @for($a = 0; $a < count($tags); $a++) <a href="{{ url('news/tags/'.urlencode($tags[$a])) }}">{{$tags[$a]}}</a>
                                    @endfor
                            </div>
                            <!-- <div class="share-items">
                                <ul class="post-social-icons list-unstyled">
                                    <li class="social-icons-head">Share:</li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div> -->
                        </div>

                    </div><!-- post-body end -->
                </div><!-- post content end -->
            </div><!-- Content Col end -->

            <div class="col-lg-4">
                <div class="sidebar sidebar-right">
                    <div class="widget recent-posts">
                        <h3 class="widget-title">Recent Posts</h3>
                        <ul class="list-unstyled">
                            @for($a = 0; $a < count($news->data->getOther); $a++)
                                <li class="d-flex align-items-start"> <!-- Changed to align-items-start -->
                                    <div class="posts-thumb">
                                        <a href="{{ url('news/'.$news->data->getOther[$a]->id) }}">
                                            <img loading="lazy" alt="{{ $news->data->getOther[$a]->image_ori }}" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/news/'.$news->data->getOther[$a]->image) }}">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4 class="entry-title">
                                            <a href="{{ url('news/'.$news->data->getOther[$a]->id) }}">{{ $news->data->getOther[$a]->title }}</a>
                                        </h4>
                                        <div class="entry-header">
                                            <div class="post-meta">
                                                <span class="post-comment">
                                                    <i class="far fa-calendar"></i>
                                                    {{ $news->data->getOther[$a]->created_at }}
                                                </span>
                                            </div>
                                        </div><!-- header end -->
                                    </div>
                                </li><!-- 1st post end-->
                                @endfor
                        </ul>
                    </div><!-- Recent post end -->


                    <div class="widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul class="arrow nav nav-tabs">
                            @for($a = 0; $a < count($news->data->getCategory); $a++)
                                <li><a href="{{ url('news/category/'.urlencode($news->data->getCategory[$a]->id)) }}">{{ucwords($news->data->getCategory[$a]->category_name)}}</a></li>
                                @endfor
                        </ul>
                    </div>
                    <!-- Categories end -->

                    <!-- <div class="widget">
                        <h3 class="widget-title">Archives </h3>
                        <ul class="arrow nav nav-tabs">
                            <li><a href="#">Feburay 2016</a></li>
                            <li><a href="#">January 2016</a></li>
                            <li><a href="#">December 2015</a></li>
                            <li><a href="#">November 2015</a></li>
                            <li><a href="#">October 2015</a></li>
                        </ul>
                    </div> -->
                    <!-- Archives end -->

                    <div class="widget widget-tags">
                        <h3 class="widget-title">Tags </h3>

                        <ul class="list-unstyled">
                            @for($a = 0; $a < count($news->data->getTag); $a++)
                                <li><a href="{{ url('news/tags/'.urlencode($news->data->getTag[$a]->tag)) }}">{{$news->data->getTag[$a]->tag}}</a></li>
                                @endfor
                        </ul>
                    </div>
                    <!-- Tags end -->


                </div><!-- Sidebar end -->
            </div><!-- Sidebar Col end -->

        </div><!-- Main row end -->

    </div><!-- Conatiner end -->
</section><!-- Main container end -->
@endsection