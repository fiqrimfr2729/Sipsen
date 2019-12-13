<div class="col-md-12">
  <div class="panel">
    <div class="panel-heading">
      <h3> Kelas XII</h3>
    </div>
    <div class="form-group" style="margin-top:10px; margin-left:10px;">
      <button class="btn btn-raised btn-success" href="<?php echo base_url(''); ?>siswa/form"><i class="fas fa-plus"></i> Tambah data</button>
      <button class="btn btn-raised btn-primary"><i class="fas fa-file-download"></i> Unduh .xlsx</button>
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
              <th width="25%"> </th>
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
                  <td><?php echo $siswas->nama; ?></td>
                  <td><?php echo $siswas->NIS; ?></td>
                  <td><?php echo $siswas->id_kelas->nama; ?></td>
                  <td><?php echo $siswas->id_fp; ?></td>
                  <td>
                    <a data-target="#modalFormDetail<?php echo $siswas->NIS ?>" data-toggle="modal" class=" btn ripple-infinite btn-info" data-placement="top" title="Detail"><span class="fas fa-list"></span></a>
                    <a data-target="#modalFormEdit<?php echo $siswas->NIS ?>" data-toggle="modal" class=" btn  ripple-infinite btn-primary" data-placement="top" title="Ubah"><span class="fas fa-edit"></span></a>
                    <a data-target="#modalResetPWD<?php echo $siswas->NIS ?>" data-toggle="modal" class=" btn  ripple-infinite btn-info" data-placement="top" title="Reset Password"><span class="fas fa-sync"></span></a>
                    <a data-target="#modalHapusGuru<?php echo $siswas->NIS ?>" data-toggle="modal" class=" btn  ripple-infinite btn-danger" data-placement="top" title="Hapus"><span class="fas fa-trash"></span></a>
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