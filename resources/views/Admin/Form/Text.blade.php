<style>
  .image-container {
    width: 100%;
    height: 30vh;
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
      <!-- TinyMCE Editor -->
      <!-- <label for="formFile" class="form-label">Template Position</label> -->
      <!-- <div class="image-container" style="margin-bottom: 50px;">
        <img loading="lazy" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/img/slides-1.jpg') }}" alt="image">
      </div> -->
      <label for="formFile" class="form-label">Description</label>
      <textarea class="tinymce-seditor validate" name="description">
      {!!$data->data->description!!}
      </textarea>
      <!-- End TinyMCE Editor -->
    </div>
    <div class="text-center">
      <input type="hidden" name="id" value="{{$id}}">
      <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form><!-- End Multi Columns Form -->
</div>

<script type="text/javascript">
  tinymce.init({
    selector: 'textarea.tinymce-seditor',
    plugins: 'paste',
    toolbar: 'paste',
    paste_data_images: true,
    images_upload_url: "{{ URL::asset(env('APP_URL').'/uploads') }}", // URL untuk mengunggah gambar
    setup: function(editor) {
      editor.on('change', function() {
        tinymce.triggerSave();
        $(editor.getElement()).valid(); // Trigger validation on change
      });

      // Handler untuk mengelola gambar yang disalin dan ditempelkan
      editor.on('paste', function(e) {
        var clipboardData = e.clipboardData || e.originalEvent.clipboardData;
        var items = clipboardData.items;

        for (var i = 0; i < items.length; i++) {
          if (items[i].type.indexOf("image") !== -1) {
            var blob = items[i].getAsFile();
            var formData = new FormData();
            formData.append('file', blob, 'image.png'); // Nama file dapat disesuaikan

            // Kirim gambar ke server
            $.ajax({
              url: "{{ URL::asset(env('APP_URL').'/admin-page/upload-image') }}",
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              success: function(data) {
                // URL gambar dari server
                var imageUrl = data.imageUrl;

                // Masukkan URL gambar ke dalam editor
                editor.insertContent('<img src="' + imageUrl + '">');
              },
              error: function(err) {
                console.error('Error uploading image:', err);
              }
            });
          }
        }
      });
    }
  });


  $(document).ready(function() {
    $('#formInput').validate({
      ignore: [],
      rules: {
        title: {
          required: true
        },
        short_description: {
          required: true
        },
        description: {
          required: true
        },
      },
      messages: {
        title: {
          required: "Title is required."
        },
        short_description: {
          required: "Short description is required."
        },
        description: {
          required: "Description is required."
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
          url: "{{ URL::asset(env('APP_URL').'/admin-page/home/do-add-static') }}",
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
              var dataTable = $('#users-table').DataTable();
              dataTable.ajax.reload(null, false);
              $("#btnSubmit").prop("disabled", false);
            } else {
              $('#modalAction').modal('hide');
              toastr.error('Failed to submit.', 'Failed!', {
                timeOut: 2000
              });
              $("#btnSubmit").prop("disabled", false);
            }
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
</script>