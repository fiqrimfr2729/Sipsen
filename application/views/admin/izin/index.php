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
                                                <td><?php echo $izinn->status; ?></td>
                                                <td><?php echo $izinn->jenis_izin; ?></td>
                                                <td><a data-target="#<?php echo $izinn->id_izin; ?>" data-toggle="modal" class=" btn  ripple-infinite btn-primary" data-placement="top" title="Ubah"><span class="fas fa-edit"></span></a>
                                                    <a data-target="#<?php echo $izinn->id_izin; ?>" data-toggle="modal" class=" btn  ripple-infinite btn-danger" data-placement="top" title="Hapus"><span class="fas fa-trash"></span></a>
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