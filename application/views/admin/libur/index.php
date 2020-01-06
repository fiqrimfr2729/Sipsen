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
                        <h3 class="animated fadeInLeft">Data Libur</h3>
                        <p class="animated fadeInDown">
                            Dashboard <span class="fa-angle-right fa"></span> Libur <span class="fa-angle-right fa"></span> Data Libur
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3>Data Libur</h3>
                        </div>
                        <div class="form-group" style="margin-top:10px; margin-left:10px;">
                            <button data-toggle="modal" data-target="#modalTambahLibur" class="btn btn-raised btn-success"><i class="fas fa-plus"></i> Tambah data</button>
                        </div>
                        <div class="panel-body">
                            <div class="responsive-table">
                                <table id="" class="table table-striped table-bordered display" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php
                                        foreach ($libur as $liburs) :
                                        ?>
                                            <tr>
                                                <td><?php echo $i;
                                                    $i++; ?></td>
                                                <td><?php echo $liburs->tanggal; ?></td>
                                                <td><?php echo $liburs->keterangan; ?></td>
                                                <td>
                                                    <a data-target="#modalEditLibur<?php echo $liburs->id; ?>" data-toggle="modal" class=" btn  ripple-infinite btn-primary" data-placement="top" title="Ubah"><span class="fas fa-edit"></span></a>
                                                    <a data-target="#modalHapusLibur<?php echo $liburs->id; ?>" data-toggle="modal" class=" btn  ripple-infinite btn-danger" data-placement="top" title="Hapus"><span class="fas fa-trash"></span></a>
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
        <!-- end: content -->

        <?php foreach ($libur as $liburs) : ?>

            <!-- Modal Tambah Libur -->
            <div class="modal fade" id="modalTambahLibur" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Tambah Data Libur</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('') ?>libur/tambah" method="post">
                                <div class="form-group">
                                    <label for="Nama Jurusan">Tanggal</label>
                                    <span id="pesan" class="error"></span></p>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="" placeholder="" required />
                                </div>
                                <div class="form-group">
                                    <label for="Nama Kategori">Keterangan</label>
                                    <span id="pesan" class="error"></span></p>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="" placeholder="Masukkan Keterangan" required />
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

            <!-- MODAL EDIT -->
            <div class="modal fade" id="modalEditLibur<?php echo $liburs->id; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Edit Data Libur</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('') ?>libur/edit" method="post">

                                <div class="form-group">
                                    <label for="Tanggal">Tanggal</label>
                                    <input name="tanggal" id="tanggal" value="<?php echo $liburs->tanggal ?>" class="form-control" type="date" required>
                                </div>

                                <div class="form-group">
                                    <label for="Nama Jurusan">Keterangan</label>
                                    <input type="text" class="form-control" value="<?php echo $liburs->keterangan ?>" id="keterangan" name="keterangan" required />
                                </div>

                                <div class="form-group">
                                    <input type="hidden" class="form-control" value="<?php echo $liburs->id ?>" id="id" name="id" required />
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

            <div class="modal fade" id="modalHapusLibur<?php echo $liburs->id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                            <h3 class="modal-title" id="myModalLabel">Hapus Data Libur</h3>
                        </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'libur/delete' ?>">
                            <div class="modal-body">
                                <p>Anda yakin mau menghapus data libur pada tanngal <b><?php echo $liburs->tanggal; ?></b></p>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id" value="<?php echo $liburs->id; ?>">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


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