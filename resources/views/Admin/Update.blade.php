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
  <form class="row g-3">
    <div class="col-md-12">
      <!-- TinyMCE Editor -->
      <label for="formFile" class="form-label">Template Position</label>
      <div class="image-container" style="margin-bottom: 50px;">
        <img loading="lazy" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/img/slides-1.jpg') }}" alt="image">
      </div>
      <label for="formFile" class="form-label">Description</label>
      <textarea class="tinymce-seditor">
        <section id="ts-features" class="ts-features">
            <div class="container">
                <div class="row">
                  <div class="col-lg-6">
                      <div class="ts-intro">
                          <h3 class="into-sub-title">sacasasdsad</h3>
                          sacasasdsad
                      </div><!-- Intro box end -->
                  </div><!-- Col end -->
                  <div class="col-lg-6">
                      <div class="ts-intro">
                          <h3 class="into-sub-title">sacasasdsad</h3>
                          sacasasdsad
                      </div><!-- Intro box end -->
                  </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </section><!-- Feature are end -->
      </textarea>
      <!-- End TinyMCE Editor -->
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form><!-- End Multi Columns Form -->
</div>