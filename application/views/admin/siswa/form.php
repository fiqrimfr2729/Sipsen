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
                      <h3 class="animated fadeInLeft">Form Siswa</h3>
                      <p class="animated fadeInDown">
                        Dashboard <span class="fa-angle-right fa"></span> Siswa <span class="fa-angle-right fa"></span> Form Siswa
                      </p>
                  </div>
                </div>
            </div>
            <div class="col-md-12 top-20 padding-0">
            <div class="col-md-12">
              <div class="col-md-12 panel">
                <div class="panel-heading">
                        <h4>Tambah Data Siswa</h4>
                  </div>
                  <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                    <div class="col-md-12">
                      <form class="cmxform" id="signupForm" method="get" action="">
                        <div class="col-md-6">

                          <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" class="form-text" id="validate_firstname" name="validate_firstname" required="">
                            <span class="bar"></span>
                            <label>Nama Lengkap</label>
                          </div>

                          <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" class="form-text mask-number" id="validate_nisn" name="validate_nisn" required>
                            <span class="bar"></span>
                            <label>NISN</label>
                          </div>

                          <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" class="form-text" id="validate_email" name="validate_email" required>
                            <span class="bar"></span>
                            <label>Email</label>
                          </div>

                          <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" class="form-text" id="" name="nama_ayah" required>
                            <span class="bar"></span>
                            <label>Nama Ayah</label>
                          </div>

                          <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                  Pilih Jurusan
                                  <select class="form-control">
                                    <option>-Jurusan-</option>
                                    <option>Teknik Komputer dan Jaringan</option>
                                    <option>Teknik Otomotif Kendaraan Ringan</option>
                                  </select>

                          </div>

                          <div class="form-group form-animate-text" style="margin-top:10px !important;">
                            Tingkat
                              <div class="" style="margin-top:10px;">
                                <input type="radio" name="option"> X
                                <input type="radio" name="option"> XI
                                <input type="radio" name="option"> XII
                              </div>

                          </div>

                          <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                Nama Kelas
                                <select class="form-control">
                                  <option>-Nama Kelas-</option>
                                  <option>TKJ 1</option>
                                  <option>TKJ 2</option>
                                </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" class="form-text mask-number" id="validate_nis" name="validate_nis" required>
                            <span class="bar"></span>
                            <label>NIS</label>
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

                          <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" class="form-text" id="" name="nama_ibu" required>
                            <span class="bar"></span>
                            <label>Nama Ibu</label>
                          </div>

                          <div class="form-group input-group form-animate-text" style="margin-top:60px !important;">
                            <input type="text" class="form-text mask-date" placeholder="00/00/0000" aria-describedby="basic-addon2">
                            <span class="bar"></span>
                            <label>Tanggal Lahir</label>
                            <span class="input-group-addon" id="basic-addon2">Tanggal/Bulan/Tahun</span>
                          </div>

                          <div class="form-group form-animate-text" style="margin-top:50px !important;">
                              Jenis Kelamin
                                <div class="" style="margin-top:10px;">
                                  <input type="radio" name="jk" required> Laki-laki
                                  <input type="radio" name="jk"> Perempuan
                                </div>
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
