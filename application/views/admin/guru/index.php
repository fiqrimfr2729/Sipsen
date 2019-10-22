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
      <div class="tabs-wrapper text-center">
        <div class="panel box-shadow-none text-left content-header">
          <div class="panel-body" style="padding-bottom:0px;">
            <div class="col-md-12">
              <h3 class="animated fadeInLeft">Data Guru</h3>
              <p class="animated fadeInDown">
                Dashboard <span class="fa-angle-right fa"></span> Guru <span class="fa-angle-right fa"></span> Data Guru
              </p>
            </div>
            <ul id="tabs-demo" class="nav nav-tabs content-header-tab" role="tablist" style="padding-top:10px;">
              <li role="presentation" class="active">
                <a href="#tab-guru" id="tabs2" data-toggle="tab">Guru</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab-bk" id="tabs2" data-toggle="tab">BK</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-md-12 tab-content">

          <div role="tabpanel" class="tab-pane fade active in" id="tab-guru" aria-labelledby="tabs1">
            <?php $this->load->view('admin/guru/guru'); ?>
          </div>
          <div role="tabpanel" class="tab-pane fade active" id="tab-bk" aria-labelledby="tabs2">
            <?php $this->load->view('admin/guru/BK'); ?>
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
