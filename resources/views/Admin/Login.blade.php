<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Pages / Login - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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

  <!-- Template Main CSS File -->
  <link href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <img style="max-width: 50%;margin-left:90px" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/footer-logo2.png') }}" alt="PT Cakrawala Synergy Perkasa">
                    <h5 class="card-title text-center pb-0 fs-4">Dashboard Admin</h5>
                  </div>

                  <form class="row g-3 needs-validation" id="formInput" type="POST" novalidate>

                    <div class="col-12">
                      <div class="alert alert-danger" role="alert" id='failed-alert' style="display: none;">
                        Login failed, username and password not match
                      </div>
                      <div class="alert alert-success" role="alert" id='success-alert' style="display: none;">
                        Login success
                      </div>
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <!-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div> -->
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/js/main.js') }}"></script>
  <!-- initialize jQuery Library -->
  <script src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/plugins/jQuery/jquery.min.js') }}"></script>

</body>

</html>

<script type="text/javascript">
  $(document).on("submit", "#formInput", function(event) {
    $('.loading').show();
    //stop submit the form, we will post it manually.
    event.preventDefault();
    // Get form
    var form = $('#formInput')[0];
    // Create an FormData object
    var data = new FormData(form);
    // If you want to add an extra field for the FormData
    data.append("CustomField", "This is some extra data, testing");
    // disabled the submit button
    $("#btnSubmit").prop("disabled", true);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      async: true,
      dataType: "json",
      enctype: 'multipart/form-data',
      url: "{{ URL::asset(env('APP_URL').'/admin-page/do-login') }}",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      success: function(data) {
        $('.loading').hide();
        if (data.response_code == '200') {
          $("#success-alert").show(); // use slide down for animation
          setTimeout(function() {
            $("#success-alert").slideUp(500);
            window.location.href = "{{ URL::asset(env('APP_URL').'/admin-page/home') }}";
          }, 2500);
        } else {
          $("#failed-alert").show(); // use slide down for animation
          setTimeout(function() {
            $("#failed-alert").slideUp(500);
          }, 2500);
        }
      },
      error: function(e) {
        $("#result").text(e.responseText);
        console.log("ERROR : ", e);
        $("#btnSubmit").prop("disabled", false);
      }
    });
    event.stopImmediatePropagation();
    return false;
  });
</script>