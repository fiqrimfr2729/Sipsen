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
      <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading">
              <h3>Data Kelas</h3>
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
                      <th>Nama Kelas </th>
                      <th>Jurusan</th>
                      <th>kd_alat</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($kelas as $kelass) :  ?>
                      <tr>
                        <td><?php echo $kelass->id_kelas; ?></td>
                        <td><?php echo $kelass->tingkat;
                              echo " ";
                              echo $kelass->id_jurusan->singkatan;
                              echo " ";
                              echo $kelass->nama; ?></td>
                        <td><?php echo $kelass->id_jurusan->nama_jurusan; ?></td>
                        <td><?php echo $kelass->kd_alat; ?></td>
                        <td><a data-target="#modalEditKelas<?php echo $kelass->id_kelas; ?>" data-toggle="modal" class=" btn  ripple-infinite btn-primary" data-placement="top" title="Ubah"><span class="fas fa-edit"></span></a>
                          <a data-target="#modalHapusKelas<?php echo $kelass->id_kelas; ?>" data-toggle="modal" class=" btn  ripple-infinite btn-danger" data-placement="top" title="Hapus"><span class="fas fa-trash"></span></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
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

  <!-- MODAL TAMBAH DATA JURUSAN -->


  <div class="modal fade" id="modalAddFormKelas" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Tambah Data Kelas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('') ?>kelas/addKelas" method="post">

            <div class="form-group">
              <label for="Nama Jurusan">Id Jurusan</label>
              <span id="pesan" class="error"></span></p>
              <!-- <input type="text" class="form-control" id="id_jurusan" name="id_jurusan" placeholder="Masukkan Id Jurusan Baru" required /> -->
              <select name="id_jurusan" id="id_jurusan" class="form-control">
                <?php
                echo '<option value="">PILIH JURUSAN</option>';
                foreach ($jurusan as $jurusans) {
                  echo '<option value="' . $jurusans->id_jurusan . '"  name="id_jurusan" placeholder="' . $jurusans->id_jurusan . '">' . $jurusans->nama_jurusan . '</option>';
                }
                ?>
              </select>

            </div>

            <div class="form-group">
              <label for="Nama Tingkat">Tingkat</label>
              <span id="pesan" class="error"></span></p>
              <input type="text" class="form-control" id="tingkat" name="tingkat" placeholder="Masukkan Tingkat Baru" required />
            </div>

            <div class="form-group">
              <label for="Nama">Nama</label>
              <span id="pesan" class="error"></span></p>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Baru" required />
            </div>

            <div class="form-group">
              <label for="Nama">Kode Alat</label>
              <span id="pesan" class="error"></span></p>
              <input type="text" class="form-control" id="kd_alat" name="kd_alat" placeholder="Masukkan Kode Alat Baru" required />
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


  <!-- MODAL HAPUS DATA -->

  <?php foreach ($kelas as $kelass) : ?>

    <div class="modal fade" id="modalHapusKelas<?php echo $kelass->id_kelas; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h3 class="modal-title" id="myModalLabel">Hapus Data Kelas</h3>
          </div>
          <form class="form-horizontal" method="post" action="<?php echo base_url() . 'kelas/delete' ?>">
            <div class="modal-body">
              <p>Anda yakin mau menghapus data kelas <b><?php echo $kelass->nama; ?></b></p>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="id_kelas" value="<?php echo $kelass->id_kelas; ?>">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
              <button class="btn btn-danger">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <!-- MODAL EDIT -->

  <?php foreach ($kelas as $kelass) : ?>

    <div class="modal fade" id="modalEditKelas<?php echo $kelass->id_kelas; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Edit Data Kelas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('') ?>kelas/edit" method="post">

              <div class="form-group">
                <label for="Nama Jurusan">Id Kelas</label>
                <input name="id_kelas" value="<?php echo $kelass->id_kelas; ?>" class="form-control" type="text" placeholder="<?php echo $kelass->id_kelas; ?>" readonly>
              </div>

              <div class="form-group">
                <label for="Nama Jurusan">Tingkat</label>
                <span id="pesan" class="error"></span></p>
                <input type="text" class="form-control" id="tingkat" name="tingkat" placeholder="<?php echo $kelass->tingkat ?>" required />
              </div>
              <div class="form-group">
                <label for="Nama Kategori">Kode Alat</label>
                <span id="pesan" class="error"></span></p>
                <input type="text" class="form-control" id="kd_alat" name="kd_alat" placeholder="<?php echo $kelass->kd_alat ?>" required />
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


</body>

</html>