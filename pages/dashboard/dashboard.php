<?php
  $title = 'Dashboard';
  include('../includes/header.php');

  ?>

  <body id="app-top">
    <div class="app-wrapper">
      <?php include('../includes/sidebar.php') ?>
      <div class="app-main">
        <?php include('../includes/topbar.php') ?>
        <div class="app-content bg-white">
          <div class="app-content--inner pt-0 pb-0">
            <div class="pt-4 text-center text-xl-left">
              <div class="row">
                <div class="col-xl-4">
                  <div>
                    <ol class="d-inline-block breadcrumb text-uppercase font-size-xs p-0">
                      <li class="d-inline-block breadcrumb-item"><a href="/">Dashboard</a></li>
                    </ol>
                    <h5 class="display-4 mt-1 mb-2 font-weight-bold text-uppercase">DASHBOARD</h5>
                    <p class="text-black-50 mb-0">Welcome to Background Checker</p>
                  </div>
                </div>
                <div class="col d-flex align-items-center justify-content-start mt-4 mt-xl-0 justify-content-xl-end">
                  <div class="d-inline-block btn-group btn btn-primary coursor-pointer">
                    <div id="datepicker">
                      <i class="fa fa-calendar"></i>
                      <span class="date_title"></span>
                      <span class="date_range"></span>
                      <i class="fa fa-caret-down"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row d-flex justify-content-start">
              <!--=======================================Total Profit=========================================-->
              <div class="col-12 px-0">
                <div class="card-box">
                  <div class="col-12 mt-3">
                    <div class="card-header px-1">
                      <div class="card-header--title">
                        <small>Reports: </small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php if ($_SESSION["role"] == "admin"): ?>
                <div class="col-4">
                  <div class="card card-box card-body bg-white shadow-none mt-3">
                    <div class="align-box-row align-items-start">
                      <div class="font-weight-bold mb-2">
                        <small class=" d-block mb-1 text-uppercase">Total Packages</small>
                        <span class="font-size-xxl mt-1" data-count="number" id="total_packages">0</span>
                      </div>
                      <div class="ml-auto">
                        <div class="bg-white text-center text-success font-size-xl d-50 rounded-circle">
                          <i class="far fa-chart-bar text-primary"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="card card-box card-body bg-white shadow-none mt-3">
                    <div class="align-box-row align-items-start">
                      <div class="font-weight-bold mb-2">
                        <small class=" d-block mb-1 text-uppercase">Total Services</small>
                        <span class="font-size-xxl mt-1" data-count="number" id="total_services">0</span>
                      </div>
                      <div class="ml-auto">
                        <div class="bg-white text-center text-success font-size-xl d-50 rounded-circle">
                          <i class="far fa-chart-bar text-primary"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="card card-box card-body bg-white shadow-none mt-3">
                    <div class="align-box-row align-items-start">
                      <div class="font-weight-bold mb-2">
                        <small class=" d-block mb-1 text-uppercase">Total Blogs</small>
                        <span class="font-size-xxl mt-1" data-count="number" id="total_blogs">0</span>
                      </div>
                      <div class="ml-auto">
                        <div class="bg-white text-center text-success font-size-xl d-50 rounded-circle">
                          <i class="far fa-chart-bar text-primary"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              <?php if ($_SESSION["role"] == "user"): ?>
                <div class="col-4">
                  <div class="card card-box card-body bg-white shadow-none mt-3">
                    <div class="align-box-row align-items-start">
                      <div class="font-weight-bold mb-2">
                        <small class=" d-block mb-1 text-uppercase">Total Background checks</small>
                        <span class="font-size-xxl mt-1" data-count="number" id="total_bg_checks">0</span>
                      </div>
                      <div class="ml-auto">
                        <div class="bg-white text-center text-success font-size-xl d-50 rounded-circle">
                          <i class="far fa-chart-bar text-primary"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>

            </div>

          </div>
          <?php include('../includes/footer.php') ?>
          <script src="<?= BASE_URL ?>/assets/js/app/dashboard.js?v=<?= time(); ?>"></script>
  </body>

  </html>