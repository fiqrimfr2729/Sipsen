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
      <div class="panel box-shadow-none content-header">
        <div class="panel-body">
          <div class="col-md-12">
            <h3 class="animated fadeInLeft">Form Guru</h3>
            <p class="animated fadeInDown">
              Dashboard <span class="fa-angle-right fa"></span> Guru <span class="fa-angle-right fa"></span> Form Guru
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
          <div class="col-md-12 panel">
            <div class="panel-heading">
              <h4>Tambah Data Guru</h4>
            </div>
            <div class="col-md-12 panel-body" style="padding-bottom:30px;">
              <div class="col-md-12">
                <form class="cmxform" id="signupForm" method="post" action="<?php echo base_url('') ?>guru/addGuru">
                  <div class="col-md-6">

                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="text" class="form-text" id="validate_firstname" name="nama" required="">
                      <span class="bar"></span>
                      <label>Nama Lengkap</label>
                    </div>

                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="text" class="form-text" id="validate_email" name="email" required>
                      <span class="bar"></span>
                      <label>Email</label>
                    </div>

                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      Jenis Kelamin
                      <div class="" style="margin-top:5px;">
                        <input type="radio" name="jk" value="1" required> Laki-laki
                        <input type="radio" name="jk" value="0"> Perempuan
                      </div>
                    </div>

                    <div class="form-group form-animate-checkbox">
                      <input type="checkbox" checked="checked" class="checkbox" id="status_bk" name="status_bk" value="1">
                      <label>Guru BK</label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="text" class="form-text mask-number" id="" name="NUPTK" required>
                      <span class="bar"></span>
                      <label>NUPTK</label>
                    </div>

                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="text" class="form-text mask-phone" id="" name="no_hp" required>
                      <span class="bar"></span>
                      <label>Nomor Hp</label>
                    </div>

                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="text" class="form-text" id="" name="alamat" required>
                      <span class="bar"></span>
                      <label>Alamat</label>
                    </div>

                  </div>
                  <div class="col-md-12" style="margin-top:40px;">
                    <input class="submit btn btn-danger" type="submit" value="Submit">
                  </div>
                </form>
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
