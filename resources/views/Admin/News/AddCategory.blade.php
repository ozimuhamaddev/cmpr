<style>
  .image-container {
    width: 400px;
    /* 30% of the viewport height */
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
</style>
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  <!-- Multi Columns Form -->
  <form id="formInput" class="row g-3">
    <div class="col-md-12">
      <label for="formFile" class="form-label">Category</label>
      <input type="text" name="category_name" class="form-control" id="validationCustom03" required>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form><!-- End Multi Columns Form -->
</div>
<script type="text/javascript">
  tinymce.init({
    selector: 'textarea.tinymce-seditor',
    setup: function(editor) {
      editor.on('change', function() {
        tinymce.triggerSave();
        $(editor.getElement()).valid(); // Trigger validation on change
      });
    }
  });

  $(document).ready(function() {
    $('#formInput').validate({
      ignore: [],
      rules: {
        category_name: {
          required: true
        },
      },
      messages: {
        category_name: {
          required: "Category is required."
        }
      },
      highlight: function(element) {
        var tinymceElement = tinymce.get(element.id);
        if (tinymceElement) {
          $(tinymceElement.iframeElement).closest('.tox').addClass('has-error');
        } else {
          $(element).closest('.validate').addClass('has-error');
        }
      },
      unhighlight: function(element) {
        var tinymceElement = tinymce.get(element.id);
        if (tinymceElement) {
          $(tinymceElement.iframeElement).closest('.tox').removeClass('has-error');
        } else {
          $(element).closest('.validate').removeClass('has-error').addClass('has-success');
        }
      },
      errorElement: 'span',
      errorClass: 'help-block',
      errorPlacement: function(error, element) {
        if (element.hasClass('tinymce-seditor')) {
          error.insertAfter($(element).siblings('div.tox').last());
          error.addClass('invalid-feedback'); // Tambahkan kelas invalid-feedback
        } else {
          error.insertAfter(element);
          error.addClass('invalid-feedback'); // Tambahkan kelas invalid-feedback
        }
      }
    });

    // Submit Detail Contact
    $('#formInput').on("submit", function(event) {
      event.preventDefault(); // Stop form from submitting
      if ($('#formInput').valid()) { // Check if form is valid
        $('.loading').show();
        var form = $('#formInput')[0];
        var data = new FormData(form);
        data.append("CustomField", "This is some extra data, testing");
        $("#btnSubmit").prop("disabled", true);
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "POST",
          url: "{{ URL::asset(env('APP_URL').'/admin-page/news/do-add-category') }}",
          data: data,
          processData: false,
          contentType: false,
          dataType: "json",
          cache: false,
          timeout: 600000,
          success: function(data) {
            $('.loading').hide();
            if (data.response_code == '200') {
              $('#modalAction').modal('hide');
              toastr.success('Your action has been successfully submitted.', 'Success!');
              var dataTable = $('#data-table-category').DataTable();
              dataTable.ajax.reload(null, false);
              $("#btnSubmit").prop("disabled", false);
            } else {
              $('#modalAction').modal('hide');
              toastr.error('Failed to submit.', 'Failed!', {
                timeOut: 2000
              });
              $("#btnSubmit").prop("disabled", false);
            }
            $('#data-table').DataTable().ajax.reload();
          },
          error: function(e) {
            console.log("ERROR : ", e);
            $("#btnSubmit").prop("disabled", false);
            toastr.error('An error occurred while submitting your action.', 'Error');
          }
        });
      }
    });
  });

  $(document).ready(function() {
    var image = document.getElementById('image');

    $('#uploadImage').on('change', function(event) {
      var files = event.target.files;
      var done = function(url) {
        image.src = url;
      };
      var reader;
      var file;
      var url;

      if (files && files.length > 0) {
        file = files[0];

        if (URL) {
          done(URL.createObjectURL(file));
        } else if (FileReader) {
          reader = new FileReader();
          reader.onload = function(event) {
            done(reader.result);
          };
          reader.readAsDataURL(file);
        }
      }
    });
  });
</script>