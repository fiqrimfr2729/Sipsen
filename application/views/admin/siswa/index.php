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
              <h3 class="animated fadeInLeft">Data Siswa</h3>
              <p class="animated fadeInDown">
                Dashboard <span class="fa-angle-right fa"></span> Siswa <span class="fa-angle-right fa"></span> Data Siswa
              </p>
            </div>
            <ul id="tabs-demo" class="nav nav-tabs content-header-tab" role="tablist" style="padding-top:10px;">
              <li role="presentation" class="active">
                <a href="#tab-all" id="tabs2" data-toggle="tab">ALL</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab-x" id="tabs2" data-toggle="tab">X</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab-xi" id="tabs2" data-toggle="tab">XI</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab-xii" id="tabs2" data-toggle="tab">XII</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-md-12 tab-content">

          <div role="tabpanel" class="tab-pane fade active in" id="tab-all" aria-labelledby="tabs1">
            <?php $this->load->view('admin/siswa/All'); ?>
          </div>
          <div role="tabpanel" class="tab-pane fade active" id="tab-x" aria-labelledby="tabs2">
            <?php $this->load->view('admin/siswa/X'); ?>
          </div>
          <div role="tabpanel" class="tab-pane fade active" id="tab-xi" aria-labelledby="tabs3">
            <?php $this->load->view('admin/siswa/XI'); ?>
          </div>

          <div role="tabpanel" class="tab-pane fade active" id="tab-xii" aria-labelledby="tabs4">
            <?php $this->load->view('admin/siswa/XII'); ?>
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
