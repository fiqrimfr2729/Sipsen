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
                        <h3 class="animated fadeInLeft">Data Izin</h3>
                        <p class="animated fadeInDown">
                            Dashboard <span class="fa-angle-right fa"></span> Izin <span class="fa-angle-right fa"></span> Data Kelas
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3>Data Izin</h3>
                        </div>

                        <div class="panel-body">
                            <div class="responsive-table">
                                <table id="" class="table table-striped table-bordered display" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>NIS Siswa </th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Jenis</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($izin as $izinn) :
                                        ?>
                                            <tr>
                                                <td><?php echo $i;
                                                    $i++; ?></td>
                                                <td><?php echo $izinn->NIS; ?></td>
                                                <td><?php echo $izinn->tgl_mulai; ?></td>
                                                <td><?php
                                                    if ($izinn->status == "0")
                                                        echo "Belum Dikonfirmasi";
                                                    else echo "Sudah Dikonfirmasi"; ?></td>
                                                <td><?php echo $izinn->jenis_izin; ?></td>
                                                <td>
                                                    <a data-target="#modalFormDetail<?php echo $izinn->id_izin ?>" data-toggle="modal" class=" btn ripple-infinite btn-info" data-placement="top" title="Detail"><span class="fas fa-list"></span></a>
                                                    <a data-target="#modalFormEdit1<?php echo $izinn->id_izin ?>" data-toggle="modal" class=" btn  ripple-infinite btn-primary" data-placement="top" title="Ubah"><span class="fas fa-edit"></span></a>
                                                    <a data-target="#modalFormHapus<?php echo $izinn->id_izin ?>" data-toggle="modal" class=" btn  ripple-infinite btn-danger" data-placement="top" title="Hapus"><span class="fas fa-trash"></span></a>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php foreach ($izin as $izinn) : ?>

            <!-- MODAL EDIT -->

            <div class="modal fade" id="modalFormEdit1<?php echo $izinn->id_izin ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Ubah Konfirmasi Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url() . 'izin/edit' ?>" method="post">
                                <div class="form-group" style="margin-top:5px;">
                                    <label>Status :<br>
                                        <select name="status">
                                            <option value="0">Belum Dikonfirmasi</option>
                                            <option value="1">Sudah Dikonfirmasi</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="form-groupw">
                                    <input name="id_izin" value="<?php echo $izinn->id_izin; ?>" class="form-control" type="hidden" placeholder="<?php echo $izinn->id_izin; ?>">
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

            <!-- MODAL Detail -->

            <div class="modal fade" id="modalFormDetail<?php echo $izinn->id_izin ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Detail Data Izin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="#">
                                <div class="form-group">
                                    <label for="NIS">NIS : <input name="NIS" value="<?php echo $izinn->NIS; ?>" class="form-control" type="text" placeholder="<?php echo $izinn->NIS; ?>" readonly></label>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_mulai">Tanggal Mulai : <input name="tgl_mulai" value="<?php echo $izinn->tgl_mulai; ?>" class="form-control" type="text" placeholder="<?php echo $izinn->tgl_mulai; ?>" readonly></label>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_selesai">Tanggal Selesai: <input name="tgl_selesai" value="<?php echo $izinn->tgl_selesai; ?>" class="form-control" type="text" placeholder="<?php echo $izinn->tgl_selesai; ?>" readonly></label>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_izin">jenis izin : <input name="jenis_izin" value="<?php echo $izinn->jenis_izin; ?>" class="form-control" type="text" placeholder="<?php echo $izinn->jenis_izin; ?>" readonly></label>
                                </div>
                                <div class="form-group">
                                    <label for="Bukti">Bukti : <br><br>
                                        <img src="<?php echo base_url('uploads/' . $izinn->bukti . '.jpg'); ?>" width="569" height="600" />
                                    </label>
                                </div>
                                <div class=" form-group">
                                    <label for="tanggal_dikirim">Tanggal Dikirim : <input name="tanggal_dikirim" value="<?php echo $izinn->tanggal_dikirim; ?>" class="form-control" type="text" placeholder="<?php echo $izinn->tanggal_dikirim; ?>" readonly></label>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status : <input name="status" value="<?php echo $izinn->status; ?>" class="form-control" type="text" placeholder="<?php echo $izinn->status; ?>" readonly></label>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan : <input name="keterangan" value="<?php echo $izinn->keterangan; ?>" class="form-control" type="text" placeholder="<?php echo $izinn->keterangan; ?>" readonly></label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL HAPUS DATA -->

            <div class="modal fade" id="modalFormHapus<?php echo $izinn->id_izin ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                            <h3 class="modal-title" id="myModalLabel">Hapus Data Izin</h3>
                        </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'izin/delete' ?>">
                            <div class="modal-body">
                                <p>Apa anda yakin ?</b></p>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id_izin" value="<?php echo $izinn->id_izin; ?>">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
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