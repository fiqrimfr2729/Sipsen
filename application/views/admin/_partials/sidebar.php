<div id="left-menu">
  <div class="sub-left-menu scroll">
    <ul class="nav nav-list">
        <li><div class="left-bg"></div></li>
        <li class="time">
          <h1 class="animated fadeInLeft">21:00</h1>
          <p class="animated fadeInRight">Sat,October 1st 2029</p>
        </li>
        <li class="<?php if($menu=='dashboard')echo 'active'; ?> ripple">
          <a href="<?php echo base_url(''); ?>"><span class="fa-home fa"></span> Dashboard </a>
        </li>


        <li class="<?php if($menu=='siswa')echo 'active'; ?> ripple">
          <a href="<?php echo base_url(''); ?>siswa"><span class="fa fa-book-reader"></span> Data Siswa</a>
        </li>

        <li class="<?php if($menu=='guru')echo 'active'; ?> ripple">
          <a href="<?php echo base_url(''); ?>guru"><span class="fa fa-chalkboard-teacher"></span> Data Guru</a>
        </li>

        <li class="ripple">
          <a class="tree-toggle nav-header"><span class="fa fa-building"></span>Kelas</a>
        </li>

        <li class="ripple">
          <a class="tree-toggle nav-header"><span class="fa fa-book"></span>Jurusan</a>
        </li>
      </ul>
    </div>
</div>
