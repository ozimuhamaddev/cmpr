@extends('Frontend/Layout.Main')
@section('Content')

<section id="main-container" class="main-container">
    <div class="container">

        <div class="row text-center">
            <div class="col-12">
                <h2 class="section-title">{{$contact->data->sub_title}}</h2>
                <h3 class="section-sub-title">{{$contact->data->title}}</h3>
            </div>
        </div>
        <!--/ Title row end -->

        <div class="row">
            <div class="col-md-4">
                <div class="ts-service-box-bg text-center h-100">
                    <span class="ts-service-icon icon-round">
                        <i class="fas fa-map-marker-alt mr-0"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4>Visit Our Office</h4>
                        <p>{{$contact->data->address}}</p>
                    </div>
                </div>
            </div><!-- Col 1 end -->

            <div class="col-md-4">
                <div class="ts-service-box-bg text-center h-100">
                    <span class="ts-service-icon icon-round">
                        <i class="fa fa-envelope mr-0"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4>Email Us</h4>
                        <p>{{$contact->data->email}}</p>
                    </div>
                </div>
            </div><!-- Col 2 end -->

            <div class="col-md-4">
                <div class="ts-service-box-bg text-center h-100">
                    <span class="ts-service-icon icon-round">
                        <i class="fa fa-phone-square mr-0"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4>Call Us</h4>
                        <p>{{$contact->data->phone}}</p>
                    </div>
                </div>
            </div><!-- Col 3 end -->

        </div><!-- 1st row end -->

        <div class="gap-60"></div>

        <div class="google-map">
        <div id="map" class="map" data-latitude="40.712776" data-longitude="-74.005974" data-marker="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/marker.png') }}" data-marker-name="Constra"></div>
        </div>
    </div><!-- Conatiner end -->
</section><!-- Main container end -->
@endsection