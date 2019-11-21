<div class="col-md-12">
  <div class="panel">
    <div class="panel-heading">
      <h3> Guru</h3>
    </div>
    <div class="form-group" style="margin-top:10px; margin-left:10px;">
      <button data-toggle="modal" data-target="#modalAddFormGuru" class="btn btn-raised btn-success"><i class="fas fa-plus"></i> Tambah data</button>
    </div>
    <div class="panel-body">
      <div class="responsive-table">
        <table id="" class="table table-striped table-bordered display" width="100%" cellspacing="0">
          <thead>
            <th width="5%">No</th>
            <th width="30%">Nama</th>
            <th>NUPTK</th>
            <th>Email</th>
            <th>No HP</th>
            <th>action</th>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($guru as $gurus) :  ?>
              <tr>
                <td><?php echo $i;
                      $i++; ?></td>
                <td><?php echo $gurus->nama; ?></td>
                <td><?php echo $gurus->NUPTK; ?></td>
                <td><?php echo $gurus->email; ?></td>
                <td><?php echo $gurus->no_hp; ?></td>
                <td>
                  <a data-target="#modalFormDetail<?php echo $gurus->NUPTK; ?>" data-toggle="modal" class=" btn ripple-infinite btn-info" data-placement="top" title="Detail"><span class="fas fa-list"></span></a>
                  <a data-target="#modalFormJurusan" data-toggle="modal" class=" btn  ripple-infinite btn-primary" data-placement="top" title="Ubah"><span class="fas fa-edit"></span></a>
                  <a data-target="#modalHapusGuru<?php echo $gurus->NUPTK; ?>" data-toggle="modal" class=" btn  ripple-infinite btn-danger" data-placement="top" title="Hapus"><span class="fas fa-trash"></span></a>
                </td>

              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- MODAL EDIT -->

<?php foreach ($guru as $gurus) : ?>

  <div class="modal fade" id="modalFormDetail<?php echo $gurus->NUPTK; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Detail Data Guru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="#" method="#">
            <div class="form-group">
              <label for="Nama Jurusan">NUPTK : <input name="NUPTK" value="<?php echo $gurus->NUPTK; ?>" class="form-control" type="text" placeholder="<?php echo $gurus->NUPTK; ?>" readonly></label>
            </div>
            <div class="form-group">
              <label for="Nama Jurusan">Nama : <input name="nama" value="<?php echo $gurus->nama; ?>" class="form-control" type="text" placeholder="<?php echo $gurus->nama; ?>" readonly></label>
            </div>
            <div class="form-group">
              <label for="Nama Kategori">Alamat :</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $gurus->alamat; ?>" placeholder="<?php echo $gurus->alamat; ?>" readonly />
            </div>
            <div class="form-group">
              <label for="Nama Kategori">No Hp :</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $gurus->no_hp; ?>" placeholder="<?php echo $gurus->no_hp; ?>" readonly />
            </div>
            <div class="form-group">
              <label for="Nama Kategori">Email :</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $gurus->email; ?>" placeholder="<?php echo $gurus->email; ?>" readonly />
            </div>
            <div class="form-group">
              <label for="Nama Kategori">JK :</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="
              <?php
                if ($gurus->jk == "0") {
                  echo "Perempuan";
                } else {
                  echo "Laki - Laki";
                }
                ?>" placeholder="<?php echo $gurus->jk; ?>" readonly />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- MODAL TAMBAH DATA Guru -->

<?php foreach ($guru as $gurus) : ?>

  <div class="modal fade" id="modalAddFormGuru" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Tambah Data Guru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('') ?>guru/addGuru" method="post">

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

<?php foreach ($guru as $gurus) : ?>

  <div class="modal fade" id="modalHapusGuru<?php echo $gurus->NUPTK; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h3 class="modal-title" id="myModalLabel">Hapus Data Guru</h3>
        </div>
        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'guru/delete' ?>">
          <div class="modal-body">
            <p>Anda yakin mau menghapus data Guru <b><?php echo $gurus->nama; ?> ?</b></p>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="NUPTK" value="<?php echo $gurus->NUPTK; ?>">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-danger">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>