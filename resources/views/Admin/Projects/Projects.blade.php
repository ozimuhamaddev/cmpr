@extends('Admin/Layout.Main')
@section('Content')
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Projects</h5>
                            <button class="btn btn-success" dataaction="add" dataid="id" onclick="getaction(this)"><i class="fa fa-plus" aria-hidden="true"></i> Create Projects</button>
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
                "url": "{{ URL::asset(env('APP_URL').'/admin-page/projects/listdata') }}",
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
                    data: 'proj_category_name',
                    name: 'proj_category_name',
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
                        $.get("{{ URL::asset(env('APP_URL').'/admin-page/projects/do-delete') }}", {
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

            $.get("{{ URL::asset(env('APP_URL').'/admin-page/projects/edit') }}", {
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

            $.get("{{ URL::asset(env('APP_URL').'/admin-page/projects/add') }}", {},
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
</script>
@endsection