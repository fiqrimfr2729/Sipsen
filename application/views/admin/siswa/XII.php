<div class="col-md-12">
  <div class="panel">
    <div class="panel-heading">
      <h3> Kelas XII</h3>
    </div>
    <div class="form-group" style="margin-top:10px; margin-left:10px;">
      <a class="btn btn-raised btn-success" href="<?php echo base_url(''); ?>siswa/form"><i class="fas fa-plus"></i> Tambah data</a>
    </div>
    <div class="panel-body">
      <div class="responsive-table">
        <table id="" class="table table-striped table-bordered display" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th width="30%">Nama</th>
              <th>NIS</th>
              <th>Kelas</th>
              <th width="10%">ID FP</th>
              <th width="25%">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($siswa as $siswas) :
              if ($siswas->id_kelas->tingkat == "XII") :
            ?>
                <tr>
                  <td><?php echo $i;
                      $i++; ?></td>
                  <td><?php echo $siswas->nama_siswa; ?></td>
                  <td><?php echo $siswas->NIS; ?></td>
                  <td><?php echo $siswas->id_kelas->tingkat;
                      echo " ";
                      echo $siswas->id_kelas->jurusan->singkatan;
                      echo " ";
                      echo $siswas->id_kelas->nama; ?></td>
                  <td><?php echo $siswas->id_fp; ?></td>
                  <td>
                    <a data-target="#modalFormDetailXII<?php echo $siswas->NIS ?>" data-toggle="modal" class=" btn ripple-infinite btn-info" data-placement="top" title="Detail"><span class="fas fa-list"></span></a>
                    <a data-target="#modalFormEditXII<?php echo $siswas->NIS ?>" data-toggle="modal" class=" btn  ripple-infinite btn-primary" data-placement="top" title="Ubah"><span class="fas fa-edit"></span></a>
                    <a data-target="#modalResetPWDXII<?php echo $siswas->NIS ?>" data-toggle="modal" class=" btn  ripple-infinite btn-info" data-placement="top" title="Reset Password"><span class="fas fa-sync"></span></a>
                    <a data-target="#modalHapusGuruXII<?php echo $siswas->NIS ?>" data-toggle="modal" class=" btn  ripple-infinite btn-danger" data-placement="top" title="Hapus"><span class="fas fa-trash"></span></a>
                  </td>
                </tr>
            <?php endif;
            endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php foreach ($siswa as $siswas) : ?>

  <!-- MODAL Detail -->

  <div class="modal fade" id="modalFormDetailXII<?php echo $siswas->NIS ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Detail Data Siswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="#" method="#">
            <div class="form-group">
              <label for="NIS">NIS : <input name="NIS" value="<?php echo $siswas->NIS; ?>" class="form-control" type="text" placeholder="<?php echo $siswas->NIS; ?>" readonly></label>
            </div>
            <div class="form-group">
              <label for="NISN">NISN : <input name="nama" value="<?php echo $siswas->NISN; ?>" class="form-control" type="text" placeholder="<?php echo $siswas->NISN; ?>" readonly></label>
            </div>
            <div class="form-group">
              <label for="Alamat">Nama :</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $siswas->nama_siswa; ?>" placeholder="<?php echo $siswas->nama_siswa; ?>" readonly />
            </div>
            <div class="form-group">
              <label for="No Hp">No Hp :</label>
              <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $siswas->no_hp; ?>" placeholder="" readonly />
            </div>

            <div class="form-group">
              <label for="ID KELAS">Kelas :</label>
              <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo $siswas->id_kelas->tingkat;
                                                                                      echo " ";
                                                                                      echo $siswas->id_kelas->jurusan->singkatan;
                                                                                      echo " ";
                                                                                      echo $siswas->id_kelas->nama; ?>" placeholder="" readonly />
            </div>
            <div class="form-group">
              <label for="JK">JK :</label>
              <input type="text" class="form-control" id="jk" name="jk" value="
        <?php
        if ($siswas->jk == "0") {
          echo "Perempuan";
        } else {
          echo "Laki - Laki";
        } ?>" placeholder="" readonly />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL HAPUS DATA -->

  <div class="modal fade" id="modalHapusSiswaXII<?php echo $siswas->NIS ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h3 class="modal-title" id="myModalLabel">Hapus Data Siswa</h3>
        </div>
        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'siswa/delete' ?>">
          <div class="modal-body">
            <p>Anda yakin mau menghapus data Siswa <b><?php echo $siswas->nama_siswa; ?> ?</b></p>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="NIS" value="<?php echo $siswas->NIS; ?>">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-danger">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- MODAL EDIT -->

  <div class="modal fade" id="modalFormEditXII<?php echo $siswas->NIS ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Edit Data Siswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url() . 'siswa/edit' ?>" method="post">
            <div class="form-group">
              <label for="NIS">NIS : <input name="NIS" value="<?php echo $siswas->NIS; ?>" class="form-control" type="text" placeholder="" readonly></label>
            </div>
            <div class="form-group">
              <label for="NISN">NISN : <input name="NISN" value="<?php echo $siswas->NISN; ?>" pattern="[0-9]+" title="Hannya Menggunakan Angka" class="form-control" type="text" placeholder="" required></label>
            </div>
            <div class="form-group">
              <label for="NAMA">Nama : <input name="nama" value="<?php echo $siswas->nama_siswa; ?>" pattern="[a-zA-Z\s]+" title="Hannya Menggunakan Huruf" class="form-control" type="text" placeholder="" required></label>
            </div>
            <div class="form-group form-animate-text" style="margin-top:40px !important;">
              Kelas

              <select name="id_kelas" id="#" class="form-control" required>
                <?php

                $kelas = $this->M_kelas->getNamaKelas();
                echo '<option value="">PILIH KELAS</option>';
                foreach ($kelas as $kelass) {
                  echo '<option value="' . $kelass->id_kelas . '"  name="id_kelas" placeholder="' . $kelass->id_kelas . '">' . $kelass->kelas . '</option>';
                }
                ?>
              </select>
            </div>

            <div class="form-group" style="margin-top:5px;">
              <label>Jenis Kelamin :<br>
                <?php if ($siswas->jk == "1") : ?>
                  <input type="radio" name="jk" value="1" checked required> Laki-laki
                  <input type="radio" name="jk" value="0"> Perempuan
                <?php else : ?>
                  <input type="radio" name="jk" value="1" required> Laki-laki
                  <input type="radio" name="jk" value="0" checked> Perempuan
                <?php endif; ?>
              </label>
            </div>

            <div class="form-group">
              <label for="tgl_lahir">Tanggal Lahir :
                <input type="date" id="tgl_lahir" class="form-text form-control" placeholder="<?php echo $siswas->tgl_lahir ?>" value="<?php echo $siswas->tgl_lahir ?>" aria-describedby="basic-addon2" name="tgl_lahir" required>
            </div>

            <div class="form-group">
              <label>Nomor Hp :
                <input type="text" class="form-text mask-phone form-control" id="" pattern="[0-9]+" title="Hannya Menggunakan Angka" name="no_hp" value="<?php echo $siswas->no_hp ?>" required>
                <span class="bar"></span>
              </label>
            </div>

            <div class="form-group">
              <label>Email :
                <input type="email" class="form-text form-control" value="<?php echo $siswas->email ?>" id="validate_email" name="email" required>
                <span class="bar"></span>
              </label>
            </div>

            <div class="form-group">
              <label>Alamat :
                <input type="text" class="form-text form-control" id="" value="<?php echo $siswas->alamat ?>" name="alamat" required>
                <span class="bar"></span>
              </label>
            </div>

            <div class="form-group">
              <label>Nama Ibu :
                <input type="text" class="form-text form-control" id="" value="<?php echo $siswas->nama_ibu ?>" name="nama_ibu" required>
                <span class="bar"></span>
              </label>
            </div>

            <div class="form-group">
              <label>Nama Ayah :
                <input type="text" class="form-text form-control" id="" value="<?php echo $siswas->nama_ayah ?>" name="nama_ayah" required>
                <span class="bar"></span>
              </label>
            </div>

            <div class="form-group">
              <label>ID FP
                <input type="text" class="form-text" id="" value="<?php echo $siswas->id_fp ?>" pattern="[0-9]+" title="Hannya Menggunakan Angka" name="id_fp" required>
                <span class="bar"></span>
              </label>
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

  <!-- MODAL RESET PASSWORD -->

  <div class="modal fade" id="modalResetPWDXII<?php echo $siswas->NIS ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h3 class="modal-title" id="myModalLabel">Reset Password Guru</h3>
        </div>
        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'siswa/resetPWD' ?>">
          <div class="modal-body">
            <p>Anda yakin mau mereset password Siswa <b><?php echo $siswas->nama_siswa; ?> ?</b></p>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="NIS" value="<?php echo $siswas->NIS; ?>">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-danger">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php endforeach; ?>