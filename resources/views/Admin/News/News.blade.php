@extends('Admin/Layout.Main')
@section('Content')
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: 20px;">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#news" type="button" role="tab" aria-controls="news" aria-selected="true">News</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#category" type="button" role="tab" aria-controls="category" aria-selected="false">Category News</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="news" role="tabpanel" aria-labelledby="news-tab">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title">News</h5>
                                    <button class="btn btn-success" dataaction="add" dataid="id" onclick="getaction(this)"><i class="fa fa-plus" aria-hidden="true"></i> Create News</button>
                                </div>
                                <table class="table border table-bordered table-hover" id="data-table">
                                    <thead>
                                        <th width="5%">no</th>
                                        <th width="30%">title</th>
                                        <th>category</th>
                                        <th>created at</th>
                                        <th>Updated at</th>
                                        <th>Action</th>
                                    </thead>
                                </table>
                                <!-- End Table with stripped rows -->
                            </div>
                            <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title">Category</h5>
                                    <button class="btn btn-success" dataaction="addCategory" dataid="id" onclick="getaction(this)"><i class="fa fa-plus" aria-hidden="true"></i> Create Category</button>
                                </div>
                                <table class="table border table-bordered table-hover" id="data-table-category">
                                    <thead>
                                        <th width="5%">no</th>
                                        <th width="80%">category</th>
                                        <th>Action</th>
                                    </thead>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<!-- End #main -->
@endsection

@section('Scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var dataTable = $('#data-table').DataTable({
            "dom": '<"bottom"f>rt<"bottom"lpi><"clear">',
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "order": [
                [0, "DESC"]
            ],
            "ajax": {
                "url": "{{ URL::asset(env('APP_URL').'/admin-page/news/listdata') }}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token() ?>"
                }
            },
            "columns": [{
                    data: 'no',
                    name: 'no'
                },
                {
                    data: 'title',
                    name: 'title',
                    orderable: false
                },
                {
                    data: 'category_name',
                    name: 'category_name',
                    orderable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: false
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }

            ],
        });

    });

    function getaction(e) {
        $(".modal-content").html(`<div style="text-align: center; padding: 15px">
            <h2 class="mb-0">
                <span class="kt-spinner kt-spinner--lg kt-spinner--dark"></span>
                <span style="margin-left: 30px">Loading...</span>
            </h2>
            </div>`);
        linkObj = $(e);
        action = $(e).attr('dataaction');
        dataid = $(e).attr('dataid');
        var arr = dataid.split("|");
        var link = $("#link").val();

        if (action == 'delete') {
            swal({
                    html: true,
                    title: '<div style="text-align: left"><i class="fa fa-exclamation-triangle" style="color: #ffc300"></i></div>',
                    text: '<div style="text-align: left; color: #333; margin-bottom: .5rem;     font-size: 18px; font-weight: 600;">Are you sure you deleted this ?</div>',
                    // type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: 'btn btn-danger',
                    cancelButtonColor: 'btn btn-danger',
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.get("{{ URL::asset(env('APP_URL').'/admin-page/news/do-delete') }}", {
                                id: arr[0]
                            },
                            function(data) {
                                swal.close();
                                toastr.success('Delete successfully');
                                setTimeout(function() {
                                    $('#data-table').DataTable().ajax.reload();
                                }, 1000);
                            });
                    } else {
                        swal.close();
                    }
                });

        }

        if (action == 'edit') {
            $('#modalAction').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Show the modal
            $('#modalAction').modal('show');

            $.get("{{ URL::asset(env('APP_URL').'/admin-page/news/edit') }}", {
                    id: arr[0]
                },
                function(data) {
                    $(".modal-content").html(data);

                    // Initialize TinyMCE on the newly loaded content
                    tinymce.remove(); // Removes any existing instances to avoid duplicates
                    tinymce.init({
                        selector: 'textarea', // Adjust the selector as per your HTML structure
                        // Add your TinyMCE configuration options here
                    });
                });
        }

        if (action == 'add') {
            $('#modalAction').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Show the modal
            $('#modalAction').modal('show');

            $.get("{{ URL::asset(env('APP_URL').'/admin-page/news/add') }}", {},
                function(data) {
                    $(".modal-content").html(data);

                    // Initialize TinyMCE on the newly loaded content
                    tinymce.remove(); // Removes any existing instances to avoid duplicates
                    tinymce.init({
                        selector: 'textarea', // Adjust the selector as per your HTML structure
                        // Add your TinyMCE configuration options here
                    });
                });
        }


        if (action == 'deleteCategory') {
            swal({
                    html: true,
                    title: '<div style="text-align: left"><i class="fa fa-exclamation-triangle" style="color: #ffc300"></i></div>',
                    text: '<div style="text-align: left; color: #333; margin-bottom: .5rem;     font-size: 18px; font-weight: 600;">Are you sure you deleted this ?</div>',
                    // type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: 'btn btn-danger',
                    cancelButtonColor: 'btn btn-danger',
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.get("{{ URL::asset(env('APP_URL').'/admin-page/news/do-delete-category') }}", {
                                id: arr[0]
                            },
                            function(data) {
                                swal.close();
                                toastr.success('Delete successfully');
                                setTimeout(function() {
                                    $('#data-table').DataTable().ajax.reload();
                                }, 1000);
                            });
                    } else {
                        swal.close();
                    }
                });

        }

        if (action == 'editCategory') {
            $('#modalAction').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Show the modal
            $('#modalAction').modal('show');

            $.get("{{ URL::asset(env('APP_URL').'/admin-page/news/edit-category') }}", {
                    id: arr[0]
                },
                function(data) {
                    $(".modal-content").html(data);

                    // Initialize TinyMCE on the newly loaded content
                    tinymce.remove(); // Removes any existing instances to avoid duplicates
                    tinymce.init({
                        selector: 'textarea', // Adjust the selector as per your HTML structure
                        // Add your TinyMCE configuration options here
                    });
                });
        }

        if (action == 'addCategory') {
            $('#modalAction').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Show the modal
            $('#modalAction').modal('show');

            $.get("{{ URL::asset(env('APP_URL').'/admin-page/news/add-category') }}", {},
                function(data) {
                    $(".modal-content").html(data);

                    // Initialize TinyMCE on the newly loaded content
                    tinymce.remove(); // Removes any existing instances to avoid duplicates
                    tinymce.init({
                        selector: 'textarea', // Adjust the selector as per your HTML structure
                        // Add your TinyMCE configuration options here
                    });
                });
        }
    }

    $(document).ready(function() {
        var dataTable = $('#data-table-category').DataTable({
            "dom": '<"bottom"f>rt<"bottom"lpi><"clear">',
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "order": [
                [0, "DESC"]
            ],
            "ajax": {
                "url": "{{ URL::asset(env('APP_URL').'/admin-page/news/listdata-category') }}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token() ?>"
                }
            },
            "columns": [{
                    data: 'no',
                    name: 'no'
                },
                {
                    data: 'category_name',
                    name: 'category_name',
                    orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }

            ],
        });

    });
</script>
@endsection