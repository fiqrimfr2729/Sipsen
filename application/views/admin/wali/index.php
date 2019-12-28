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
            <h3 class="animated fadeInLeft">Data Kelas</h3>
            <p class="animated fadeInDown">
              Dashboard <span class="fa-angle-right fa"></span> Kelas <span class="fa-angle-right fa"></span> Data Kelas
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-12 top-20 padding-20">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading">
              <h3>Data Wali</h3>
            </div>
            <div class="form-group" style="margin-top:10px; margin-left:10px;">
              <button data-toggle="modal" data-target="#modalAddFormKelas" class="btn btn-raised btn-success"><i class="fas fa-plus"></i> Tambah data</button>
            </div>
            <div class="panel-body">
              <div class="responsive-table">
                <table id="" class="table table-striped table-bordered display" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th width="25%">Nama Wali</th>
                      <th width="25%">Username</th>
                      <th>NIS Siswa</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;?>
                    <?php foreach ($wali as $walii) : ?>
                      <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $walii->nama; ?></td>
                        <td><?php echo $walii->username; ?></td>
                        <td><?php echo $walii->siswa->NIS ?></td>
                        <td align="center">
                          <a data-toggle="modal" class=" btn ripple-infinite btn-info" data-placement="top" title="Detail"><span class="fas fa-list"></span></a>
                          <a data-toggle="modal" class=" btn  ripple-infinite btn-primary" data-placement="top" title="Ubah"><span class="fas fa-edit"></span></a>
                          <a data-toggle="modal" class=" btn  ripple-infinite btn-info" data-placement="top" title="Reset Password"><span class="fas fa-sync"></span></a>
                          <a data-toggle="modal" class=" btn  ripple-infinite btn-danger" data-placement="top" title="Hapus"><span class="fas fa-trash"></span></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
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
