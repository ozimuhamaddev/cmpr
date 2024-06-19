@extends('Frontend/Layout.Main')
@section('Content')
<!--/ Header end -->
<div id="banner-area" class="banner-area" style="background-image:url({{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/banner/banner1.jpg') }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-heading">
                        <h1 class="banner-title">News</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ asset(env('APP_URL')) }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ asset(env('APP_URL').'/news') }}">News</a></li>
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
            <div class="col-lg-4 order-1 order-lg-0">
                <div class="sidebar sidebar-left">
                    <div class="widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul class="arrow nav nav-tabs">
                            @for($a = 0; $a < count($category->data); $a++)
                                <li><a href="{{ url('news/category/'.urlencode($category->data[$a]->id)) }}">{{ucwords($category->data[$a]->category_name)}}</a></li>
                                @endfor
                        </ul>
                    </div><!-- Categories end -->

                    <div class="widget widget-tags">
                        <h3 class="widget-title">Tags </h3>

                        <ul class="list-unstyled">
                            @for($a = 0; $a < count($tags->data); $a++)
                                <li><a href="{{ url('news/tags/'.urlencode($tags->data[$a]->tag)) }}">{{ucwords($tags->data[$a]->tag)}}</a></li>
                                @endfor
                        </ul>
                    </div><!-- Tags end -->


                </div><!-- Sidebar end -->
            </div><!-- Sidebar Col end -->
            <div class="col-lg-8 mb-5 mb-lg-0 order-0 order-lg-1">

                <div id="news-container">
                    <!-- News content will be loaded here -->
                </div><!-- Content Col end -->

                <nav class="paging" aria-label="Page navigation example">
                    <ul class="pagination" id="pagination">
                    </ul>
                </nav>
            </div>
        </div><!-- Main row end -->

    </div><!-- Container end -->
</section><!-- Main container end -->
@endsection

@section('Scripts')
<script type="text/javascript">
    $(document).ready(function() {
        function loadNews(page) {
            $.ajax({
                url: "{{ asset(env('APP_URL')) }}/news-tags-list-data",
                type: "POST",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    _token: "<?= csrf_token() ?>",
                    id: "<?= $id ?>",
                    page: page
                }),
                success: function(response) {
                    $('#news-container').empty();
                    $.each(response.data, function(index, news) {
                        $('#news-container').append(
                            '<div class="post">' +
                            '<div class="post-body">' +
                            '<div class="entry-header">' +
                            '<div class="post-meta">' +
                            '<h2 class="entry-title"><a href="news-single.html?id=' + news.id + '">' + news.title + '</a></h2>' +
                            '<span class="post-author"><i class="far fa-user"></i><a href="#"> Admin</a></span>' +
                            '<span class="post-cat"><i class="far fa-folder-open"></i><a href="#"> News</a></span>' +
                            '<span class="post-meta-date"><i class="far fa-calendar"></i> ' + news.created_at + '</span>' +
                            '<span class="post-comment"><i class="far fa-comment"></i> 03<a href="#" class="comments-link">Comments</a></span>' +
                            '</div>' +
                            '</div>' +
                            '<div class="post-media post-image">' +
                            '<img loading="lazy" src="' + "{{ asset(env('GLOBAL_PLUGIN_PATH')) }}template/images/news/" + news.image + '" class="img-fluid" alt="' + news.image_ori + '">' +
                            '</div>' +
                            '<div class="entry-content"><br>' +
                            '<p>' + news.short_description + '</p>' +
                            '</div>' +
                            '<div class="post-footer">' +
                            '<a href="' + "{{asset(env('APP_URL'))}}" + '/news/' + news.id + '" class="btn btn-primary">Continue Reading</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    });

                    // Generate pagination
                    $('#pagination').empty();
                    for (var i = 1; i <= response.last_page; i++) {
                        $('#pagination').append('<li class="page-item ' + (i === response.current_page ? 'active' : '') + '"><a class="page-link" href="javascript:void(0)" data-page="' + i + '">' + i + '</a></li>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred: " + status + "\nError: " + error);
                }
            });
        }

        $(document).on('click', '.page-link', function() {
            var page = $(this).data('page');
            loadNews(page);
        });

        // Load the first page on document ready
        loadNews(1);
    });
</script>
@endsection