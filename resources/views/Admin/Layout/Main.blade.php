<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PT Cakrawala Synergy Perkasa - Company Profile</title>
    <meta name="description" content="Learn about PT Cakrawala Synergy Perkasa, our mission, values, and the services we provide.">
    <meta name="keywords" content="PT Cakrawala Synergy Perkasa, company profile, services, mission, values,listrik, electricity">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/footer-logo.png') }}" rel="icon">
    <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/footer-logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <!-- Include Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


</head>
<style>
    .dataTables_filter {
        display: none
    }

    .has-error .tox-editor-header,
    .has-error .tox-edit-area__iframe {
        border: 1px solid red !important;
    }
</style>
@yield('Css')


<body>

    <!-- Header start -->
    @include('Admin/Layout.Header', ['data' => App\Http\Controllers\Frontend\Main::getFooterData(request())])
    <!--/ Header end -->
    <!-- Header start -->
    @include('Admin/Layout.Navigation')
    <!--/ Header end -->

    <!-- Content start -->
    @yield('Content')
    <!--/ Content end -->
    <div class="modal fade" id="modalAction" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" id="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your modal body content here -->
                    <div style="text-align: center; padding: 0 15px;">
                        <h2>
                            <div class="spinner"></div><span>Loading...</span>
                        </h2>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <!-- Footer start -->
    @include('Admin/Layout.Footer')
    <!--/ Footer end -->

    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Load Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Load DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/quill/quill.js') }}"></script>
    <!-- <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script> -->
    <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/js/main.js') }}"></script>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ URL::asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ URL::asset(env('PAGES_SCRIPT_PATH').'/template-admin/assets/js/ui-sweetalert.min.js') }}" type="text/javascript"></script>

    <!-- Content start -->
    @yield('Scripts')
    <!--/ Content end -->

</body>

</html>