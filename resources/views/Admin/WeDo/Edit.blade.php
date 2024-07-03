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
      <label for="formFile" class="form-label">Title</label>
      <input type="text" name="title" class="form-control" value="{{$wedo->data->title}}" required>
    </div>
    <div class="col-md-12">
      <label for="formFile" class="form-label">Icon</label>
      <select name="icon_id" class="form-control">
        <option value="" selected>-- Choose a Category --</option>
        @for($i = 0;$i < count($icon->data);$i++)
          @if($icon->data[$i]->id == $wedo->data->icon_id)
          <option value="{{$icon->data[$i]->id}}" selected>{{ucwords($icon->data[$i]->icon_image)}}</option>
          @else
          <option value="{{$icon->data[$i]->id}}">{{ucwords($icon->data[$i]->icon_image)}}</option>
          @endif
          @endfor
      </select>
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
          url: "{{ URL::asset(env('APP_URL').'/admin-page/wedo/do-add') }}",
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