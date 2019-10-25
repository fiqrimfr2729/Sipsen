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
                      <h3 class="animated fadeInLeft">Data Jurusan</h3>
                      <p class="animated fadeInDown">
                        Dashboard <span class="fa-angle-right fa"></span> Jurusan <span class="fa-angle-right fa"></span> Data Jurusan
                      </p>
                  </div>
                </div>
            </div>
            <div class="col-md-12 top-20 padding-0">
              <div class="col-md-12">
                <div class="panel">
                  <div class="panel-heading"><h3>Data Tables</h3></div>
                  <div class="panel-body">
                    <div class="responsive-table">
                    <table id="" class="table table-striped table-bordered display" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th>Jurusan </th>
                        <th>Singkatan</th>
                        <th>Jumlah Kelas</th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align="center">1</td>
                        <td>Teknik Komputer Jaringan </td>
                        <td>TKJ</td>
                        <td> 6</td>
                        <td align="center">
                          <button class=" btn  ripple-infinite btn-primary" data-placement="top" data-toggle="tooltip" title="Ubah"><span class="fas fa-edit"></span></button>
                          <button class=" btn  ripple-infinite btn-danger" data-placement="top" data-toggle="tooltip" title="Hapus"><span class="fas fa-trash"></span></button>
                        </td>
                      </tr>
                    </tbody>
                      </table>
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
