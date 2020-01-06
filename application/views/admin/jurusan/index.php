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
            <div class="panel-heading">
              <h3>Data Jurusan</h3>
            </div>
            <div class="form-group" style="margin-top:10px; margin-left:10px;">
              <button data-toggle="modal" data-target="#modalAddFormJurusan" class="btn btn-raised btn-success"><i class="fas fa-plus"></i> Tambah data</button>
            </div>
            <div class="panel-body">
              <div class="responsive-table">
                <table id="" class="table table-striped table-bordered display" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Jurusan </th>
                      <th>Singkatan</th>
                      <th>Jumlah Kelas</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($jurusan as $jurusans) :  ?>
                      <tr>
                        <td><?php echo $i;
                              $i++; ?></td>
                        <td><?php echo $jurusans->nama_jurusan; ?></td>
                        <td><?php echo $jurusans->singkatan; ?></td>
                        <td><?php echo $jurusans->kelas; ?></td>
                        <td><a data-target="#modalFormJurusan<?php echo $jurusans->id_jurusan; ?>" data-toggle="modal" class=" btn  ripple-infinite btn-primary" data-placement="top" title="Ubah"><span class="fas fa-edit"></span></a>
                          <a data-target="#modalHapusJurusan<?php echo $jurusans->id_jurusan; ?>" data-toggle="modal" class=" btn  ripple-infinite btn-danger" data-placement="top" title="Hapus"><span class="fas fa-trash"></span></a>
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

  <!-- MODAL EDIT -->

  <?php foreach ($jurusan as $jurusans) : ?>

    <!-- Modal Tambah Jurusan -->
    <div class="modal fade" id="modalFormJurusan<?php echo $jurusans->id_jurusan; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Edit Data Jurusan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('') ?>jurusan/edit" method="post">

              <div class="form-group">
                <label for="Nama Jurusan">ID Jurusan</label>
                <input name="id_jurusan" value="<?php echo $jurusans->id_jurusan; ?>" class="form-control" type="text" placeholder="<?php echo $jurusans->id_jurusan; ?>" readonly>
              </div>

              <div class="form-group">
                <label for="Nama Jurusan">Nama Jurusan</label>
                <span id="pesan" class="error"></span></p>
                <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="<?php echo $jurusans->nama_jurusan ?>" required />
              </div>
              <div class="form-group">
                <label for="Nama Kategori">Singkatan</label>
                <span id="pesan" class="error"></span></p>
                <input type="text" class="form-control" id="singkatan" name="singkatan" placeholder="<?php echo $jurusans->singkatan ?>" required />
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Masukan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <!-- MODAL TAMBAH DATA JURUSAN -->

  <?php foreach ($jurusan as $jurusans) : ?>

    <div class="modal fade" id="modalAddFormJurusan" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Tambah Data Jurusan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('') ?>jurusan/addJurusan" method="post">

              <div class="form-group">
                <label for="Nama Jurusan">Nama Jurusan</label>
                <span id="pesan" class="error"></span></p>
                <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="Masukkan Nama Jurusan Baru" required />
              </div>

              <div class="form-group">
                <label for="Nama Kategori">Singkatan</label>
                <span id="pesan" class="error"></span></p>
                <input type="text" class="form-control" id="singkatan" name="singkatan" placeholder="Masukkan Singkatan Baru" required />
              </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Masukan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <!-- MODAL HAPUS DATA -->

  <?php foreach ($jurusan as $jurusans) : ?>

    <div class="modal fade" id="modalHapusJurusan<?php echo $jurusans->id_jurusan; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h3 class="modal-title" id="myModalLabel">Hapus Data Jurusan</h3>
          </div>
          <form class="form-horizontal" method="post" action="<?php echo base_url() . 'jurusan/delete' ?>">
            <div class="modal-body">
              <p>Anda yakin mau menghapus data jurusan <b><?php echo $jurusans->nama_jurusan; ?></b></p>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="id_jurusan" value="<?php echo $jurusans->id_jurusan; ?>">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
              <button class="btn btn-danger">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

</body>

</html>
