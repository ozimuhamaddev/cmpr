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
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#client" type="button" role="tab" aria-controls="client" aria-selected="true">Number Client</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#icon" type="button" role="tab" aria-controls="icon" aria-selected="false">Icon</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="client" role="tabpanel" aria-labelledby="client-tab">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title">Number Client</h5>
                                    <button class="btn btn-success" dataaction="add" dataid="id" onclick="getaction(this)"><i class="fa fa-plus" aria-hidden="true"></i> Create Number Client</button>
                                </div>
                                <table class="table border table-bordered table-hover" id="data-table">
                                    <thead>
                                        <th width="5%">no</th>
                                        <th width="30%">title</th>
                                        <th width="30%">Count</th>
                                        <th>icon</th>
                                        <th>Action</th>
                                    </thead>
                                </table>
                                <!-- End Table with stripped rows -->
                            </div>
                            <div class="tab-pane fade" id="icon" role="tabpanel" aria-labelledby="icon-tab">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title">Icon</h5>
                                    <button class="btn btn-success" dataaction="addIcon" dataid="id" onclick="getaction(this)"><i class="fa fa-plus" aria-hidden="true"></i> Create Icon</button>
                                </div>
                                <table class="table border table-bordered table-hover" id="data-table-icon">
                                    <thead>
                                        <th width="5%">no</th>
                                        <th width="50%">Icon Name</th>
                                        <th width="30%">Icon Image</th>
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
                "url": "{{ URL::asset(env('APP_URL').'/admin-page/numberclient/listdata') }}",
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
                    data: 'short_description',
                    name: 'short_description',
                    orderable: false
                },
                {
                    data: 'icon_image',
                    name: 'icon_image',
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
                        $.get("{{ URL::asset(env('APP_URL').'/admin-page/numberclient/do-delete') }}", {
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

            $.get("{{ URL::asset(env('APP_URL').'/admin-page/numberclient/edit') }}", {
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

            $.get("{{ URL::asset(env('APP_URL').'/admin-page/numberclient/add') }}", {},
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

        if (action == 'deleteIcon') {
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
                        $.get("{{ URL::asset(env('APP_URL').'/admin-page/home/do-delete-icon') }}", {
                                id: arr[0]
                            },
                            function(data) {
                                swal.close();
                                toastr.success('Delete successfully');
                                setTimeout(function() {
                                    $('#data-table-icon').DataTable().ajax.reload();
                                }, 1000);
                            });
                    } else {
                        swal.close();
                    }
                });

        }

        if (action == 'editIcon') {
            $('#modalAction').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Show the modal
            $('#modalAction').modal('show');

            $.get("{{ URL::asset(env('APP_URL').'/admin-page/home/edit-icon') }}", {
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

        if (action == 'addIcon') {
            $('#modalAction').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Show the modal
            $('#modalAction').modal('show');

            $.get("{{ URL::asset(env('APP_URL').'/admin-page/home/add-icon') }}", {},
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
        var dataTable = $('#data-table-icon').DataTable({
            "dom": '<"bottom"f>rt<"bottom"lpi><"clear">',
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "order": [
                [0, "DESC"]
            ],
            "ajax": {
                "url": "{{ URL::asset(env('APP_URL').'/admin-page/home/listdata-icon') }}",
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
                    data: 'icon_name',
                    name: 'icon_name',
                    orderable: false
                },
                {
                    data: 'icon_image',
                    name: 'icon_image',
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