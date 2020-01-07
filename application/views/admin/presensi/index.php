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
            <h3 class="animated fadeInLeft">Presensi</h3>
            <p class="animated fadeInDown">
              Dashboard <span class="fa-angle-right fa"></span> Presensi <span class="fa-angle-right fa"></span> Rekap Presensi
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
          <div class="col-md-12 panel">
            <div class="panel-heading">
              <h4>Rekap Presensi</h4>
            </div>
            <div class="col-md-12 panel-body" style="padding-bottom:30px;">
              <div class="col-md-12">
                <form class="cmxform" id="signupForm" method="post" action="<?php echo base_url('') ?>index.php/presensi/rekap">
                  <div class="col-md-6">
                    <div class="form-group" style="margin-top:40px !important;">
                      Pilih Kelas

                      <select name="kelas" id="kelas" class="form-control" required>
                        <?php
                        $kelas = $this->M_kelas->getNamaKelas();
                        echo '<option value="">Pilih Kelas</option>';
                        foreach ($kelas as $kelass) {
                          echo '<option value="' . $kelass->id_kelas . '"  name="id_kelas">' . $kelass->kelas . '</option>';
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group" style="margin-top:40px !important;">
                      Pilih Semester
                      <select name="semester" id="semester" class="semester form-control" required>
                        <?php
                        echo '<option value="">Pilih Semester</option>';
                        // for($i=1;$i<=6;$i++) {
                        //   echo '<option value="' . $i . '"  name="id_kelas" placeholder="' . $i . '">' . "Semester $i" . '</option>';
                      //  }
                        ?>

                      </select>
                    </div>

                    <div class="form-group" style="margin-top:40px !important;">
                      Pilih Bulan

                      <select name="bulan" id="bulan" class="form-control" required>
                        <?php
                        echo '<option value="">Pilih Bulan</option>';
                        // $kelas = $this->M_kelas->getNamaKelas();
                        // echo '<option value="">PILIH KELAS</option>';
                        // foreach ($kelas as $kelass) {
                        //   echo '<option value="' . $kelass->id_kelas . '"  name="id_kelas">' . $kelass->kelas . '</option>';
                        //}
                        ?>
                      </select>
                    </div>

                  </div>

                  <div class="col-md-6">


                  </div>
                  <div class="col-md-12" style="margin-top:40px;">
                    <input class="btn btn-raised btn-success" type="submit" value="Download">
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
