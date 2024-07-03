  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
              @for($a = 0; $a < count($data['others']->data); $a++)
                  @if($data['others']->data[$a]->menu_id == 18)
                  <img loading="lazy" style="width: 300px;" src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template/images/'.$data['others']->data[$a]->image) }}" alt="PT Cakrawala Synergy Perkasa">
                  @endif
                  @endfor
                  <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->

      <!-- <div class="search-bar">
          <form class="search-form d-flex align-items-center" method="POST" action="#">
              <input type="text" name="query" placeholder="Search" title="Enter search keyword">
              <button type="submit" title="Search"><i class="bi bi-search"></i></button>
          </form>
      </div> -->
      <!-- End Search Bar -->

      <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">

              <li class="nav-item dropdown pe-3">

                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                      <img src="{{ asset(env('GLOBAL_PLUGIN_PATH').'/template-admin/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                      <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                  </a><!-- End Profile Iamge Icon -->

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          <h6>Administrator</h6>
                          <!-- <span>Web Designer</span> -->
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <!-- <li>
                          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                              <i class="bi bi-person"></i>
                              <span>My Profile</span>
                          </a>
                      </li> -->
                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="{{ asset(env('APP_URL')) }}/admin-page/logout">
                              <i class="bi bi-box-arrow-right"></i>
                              <span>Sign Out</span>
                          </a>
                      </li>

                  </ul><!-- End Profile Dropdown Items -->
              </li><!-- End Profile Nav -->

          </ul>
      </nav><!-- End Icons Navigation -->

  </header>
  <!-- End Header -->