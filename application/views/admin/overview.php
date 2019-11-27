<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("admin/_partials/head.php") ?>

<body id="mimin" class="dashboard">
  <!-- start: Header -->
  <?php $this->load->view("admin/_partials/navbar.php") ?>
  <!-- end: Header -->

  <div class="container-fluid mimin-wrapper">
    <!-- start:Left Menu -->
    <?php $this->load->view("admin/_partials/sidebar.php") ?>
    <!-- end: Left Menu -->


    <!-- start: content -->
    <div id="content">
      <div class="panel">
        <div class="panel-body">
          <div class="col-md-6 col-sm-12">
            <h2 class="animated fadeInLeft">Selamat Datang Admin</h2>
          </div>
        </div>
      </div>

      <div class="col-md-14" style="padding:20px;">
        <div class="col-md-12 padding-0">
          <div class="col-md-12 padding-0 animated fadeInRight">
            <div class="col-md-4">
              <div class="panel box-v1">
                <div class="panel-heading bg-white border-none">
                  <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                    <h3 class="text-left">Siswa</h3>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                    <h4>
                      <i class="fa fa-book-reader fa-3x"></i>
                    </h4>
                  </div>
                </div>
                <div class="panel-body text-center">
                  <h1>320</h1>
                  <p>Data Siswa</p>
                  <hr />
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel box-v1">
                <div class="panel-heading bg-white border-none">
                  <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                    <h3 class="text-left">Guru</h3>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                    <h4>
                      <span class="fas fa-chalkboard-teacher fa-3x"></span>
                    </h4>
                  </div>
                </div>
                <div class="panel-body text-center">
                  <h1>320</h1>
                  <p>Data Guru</p>
                  <hr />
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel box-v1">
                <div class="panel-heading bg-white border-none">
                  <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                    <h3 class="text-left">Wali Siswa</h3>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                    <h4>
                      <span class="fas fa-users fa-3x icons icon text-right"></span>
                    </h4>
                  </div>
                </div>
                <div class="panel-body text-center">
                  <h1>100</h1>
                  <p>Data Wali Siswa</p>
                  <hr />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end: content -->


    <!-- start: right menu -->
    <?php $this->load->view("admin/_partials/right_menu.php") ?>
    <!-- end: right menu -->

  </div>

  <!-- start: Mobile -->
  <?php $this->load->view("admin/_partials/mobile.php") ?>
  <!-- end: Mobile -->

  <!-- start: Javascript -->
  <?php $this->load->view("admin/_partials/js.php") ?>
  <!-- end: Javascript -->
</body>

</html>