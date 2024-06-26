@extends('Admin/Layout.Main')
@section('Content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Home Settings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Home Setting</h5>
                        <!-- Table with stripped rows -->
                        <table class="table border table-bordered table-hover" id="data-table">
                            <thead>
                                <th width="80%">
                                    <b>Area Settings</b>
                                </th>
                                <th>Link</th>
                                <th>Active</th>
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
                "url": "{{ URL::asset(env('APP_URL').'/admin-page/home/listdata') }}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token() ?>"
                }
            },
            "columns": [{
                    data: 'menu_name',
                    name: 'menu_name'
                },
                {
                    data: 'link',
                    name: 'link',
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
        if (action == 'status') {
            $.get("{{ URL::asset(env('APP_URL').'/admin-page/home/do-status') }}", {
                    id: arr[0],
                    value: arr[1],
                },
                function(data) {});
        }

        if (action == 'update') {
            $('#modalAction').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Show the modal
            $('#modalAction').modal('show');

            $.get("{{ URL::asset(env('APP_URL').'/admin-page/home/update-static') }}", {
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
    }
</script>
@endsection