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
              <a href="<?php echo base_url(''); ?>wali/form" class="btn btn-raised btn-success"><i class="fas fa-plus"></i> Tambah data</a>
            </div>
            <div class="panel-body">
              <div class="responsive-table">
                <table id="" class="table table-striped table-bordered display" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th width="25%">Nama Wali</th>
                      <th width="25%">Username</th>
                      <th>Nomor Hp</th>
                      <th>NIS Siswa</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($wali as $walii) : ?>
                      <tr>
                        <td><?php echo $i;
                            $i++; ?></td>
                        <td><?php echo $walii->nama; ?></td>
                        <td><?php echo $walii->username; ?></td>
                        <td><?php echo $walii->no_hp; ?></td>
                        <td><?php echo $walii->siswa->NIS ?></td>
                        <td align="center">
                          <a data-toggle="modal" data-target="#modalFormDetail<?php echo $walii->id_wali ?>" class=" btn ripple-infinite btn-info" data-placement="top" title="Detail"><span class="fas fa-list"></span></a>
                          <a data-toggle="modal" data-target="#modalFormEdit<?php echo $walii->id_wali ?>" class=" btn  ripple-infinite btn-primary" data-placement="top" title="Ubah"><span class="fas fa-edit"></span></a>
                          <a data-toggle="modal" data-target="#modalResetPWD<?php echo $walii->id_wali ?>" class=" btn  ripple-infinite btn-info" data-placement="top" title="Reset Password"><span class="fas fa-sync"></span></a>
                          <a data-toggle="modal" data-target="#modalHapusSiswa<?php echo $walii->id_wali ?>" class=" btn  ripple-infinite btn-danger" data-placement="top" title="Hapus"><span class="fas fa-trash"></span></a>
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

    <?php foreach ($wali as $walii) : ?>
      <!-- MODAL Detail -->

      <div class="modal fade" id="modalFormDetail<?php echo $walii->id_wali; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Detail Data Wali</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="#" method="#">
                <div class="form-group">
                  <label for="username">Username : <input name="username" value="<?php echo $walii->username; ?>" class="form-control" type="text" placeholder="<?php echo $walii->username; ?>" readonly></label>
                </div>
                <div class="form-group">
                  <label for="nama">Nama : <input name="nama" value="<?php echo $walii->nama; ?>" class="form-control" type="text" placeholder="<?php echo $walii->nama; ?>" readonly></label>
                </div>
                <div class="form-group">
                  <label for="nama">Nomor HP : <input name="no_hp" value="<?php echo $walii->no_hp; ?>" class="form-control" type="text" placeholder="<?php echo $walii->no_hp; ?>" readonly></label>
                </div>
                <div class="form-group">
                  <label for="email">Email :</label>
                  <input type="text" class="form-control" id="email" name="email" value="<?php echo $walii->email; ?>" placeholder="<?php echo $walii->email; ?>" readonly />
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- MODAL EDIT -->

      <div class="modal fade" id="modalFormEdit<?php echo $walii->id_wali ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Edit Data Siswa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?php echo base_url() . 'Wali/edit' ?>" method="post">
                <div class="form-group">
                  <input name="id_wali" value="<?php echo $walii->id_wali; ?>" class="form-control" type="hidden"></label>
                </div>
                <div class="form-group">
                  <label for="Username">Username : <input name="username" value="<?php echo $walii->username; ?>" pattern="[a-zA-Z0-9]+" title="Tidak boleh ada spasi dan spesial karakter" class="form-control" type="text" placeholder=""></label>
                </div>
                <div class="form-group">
                  <label for="Nama">Nama : <input name="nama" value="<?php echo $walii->nama; ?>" pattern="[a-zA-Z]+" title="Hannya menggunakan huruf" class="form-control" type="text" placeholder="" required></label>
                </div>
                <div class="form-group">
                  <label for="nama">Nomor HP : <input name="no_hp" value="<?php echo $walii->no_hp; ?>" pattern="[0-9]+" title="Hanya menggunakan angka" class="form-control" type="text" placeholder="<?php echo $walii->no_hp; ?>" required></label>
                </div>
                <div class="form-group">
                  <label for="Email">Email : <input name="email" value="<?php echo $walii->email; ?>" class="form-control" type="email" placeholder="" required></label>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                  <button type="submit" class="btn btn-primary">Masukan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

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