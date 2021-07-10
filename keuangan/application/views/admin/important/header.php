<!-- Site wrapper -->
<div class="wrapper">
  <div class="modal fade" id="keluar">
    <div class="modal-dialog modal-sm">
       <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi Keluar</h4>
          </div>
            <div class="modal-body">
            <p>Anda yakin ingin keluar ?</p>
             <center><a href="<?php echo base_url(); ?>keluar" class="btn btn-danger"><i class="glyphicon glyphicon-ok"></i> Ya</a>
             <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        </center>
        </div>
       </div>
    </div>
  </div>
<body class="hold-transition skin-yellow-light sidebar-mini">
<header class="main-header">
  <!-- Logo -->
  <a href="<?php echo site_url('dashboard'); ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><?php echo $org; ?></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>KEUANGAN HIMALA USU</b></span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown one_admin one_admin-menu">
          <a href="#">
        <?php foreach ($data_user as $one_admin) {?>
        <img src="<?php echo base_url(); ?>assets/image/<?php echo $logo_org ;?>" class="one_admin-image" alt="User Image">
          <span class="hidden-xs"> <?php echo $one_admin->nama; ?></span>
        <?php } ?>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar one_admin panel -->
    <div class="one_admin-panel">
      <div class="pull-left image">
      <?php foreach ($data_user as $one_admin){ ?>
        <img src="<?php echo base_url(); ?>assets/image/<?php echo $logo_org ;?>" alt="Logo Organisasi">
      </div>
      <div class="pull-left info">
        <p><?php echo $one_admin->nama; ?></p>
        <p><small><?php echo $one_admin->jabatan; ?></small>
      </div>
    </div>
  <?php } ?>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="sidebar-item  has-sub" style="color:#fff; border-bottom:2px solid #008080"></li>
      <li <?php if($judul=="dashboard")echo"style='background:#f4f4f5'"?> >
        <a href="<?php echo site_url('/dashboard'); ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li <?php if($judul=="daftarpengurus")echo "style='background:#f4f4f5'";
        elseif($judul=="iuranpengurus")echo "style='background:#f4f4f5'";?> class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Pengurus</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
          <li <?php if($judul=="daftarpengurus")echo "class='active'"; ?>><a href="<?php echo site_url("/pengurus/daftarpengurus/data"); ?>"><i class="fa fa-circle-o"></i> Daftar Pengurus </a></li>
          <li <?php if($judul=="iuranpengurus")echo "class='active'"; ?>><a href="<?php echo site_url("/pengurus/iuranpengurus/data"); ?>"><i class="fa fa-circle-o"></i> Iuran Pengurus </a></li>
        </ul>
      </li>

      <li <?php if($judul=="pendapataniuran")echo "style='background:#f4f4f5'";
        else if($judul=="pendapatandonatur")echo "style='background:#f4f4f5'";
        else if($judul=="pendapatanlainnya")echo "style='background:#f4f4f5'";?> class="treeview">
          <a href="#">
            <i class="fa fa-cart-plus"></i>
            <span>Pendapatan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
          <li <?php if($judul=="pendapatankas")echo "class='active'"; ?>><a href="<?php echo site_url("/pendapatan/iuranpengurus/data"); ?>"><i class="fa fa-circle-o"></i> Pendaptan Iuran </a></li>
          <li <?php if($judul=="pendapatandonatur")echo "class='active'"; ?>><a href="<?php echo site_url("/pendapatan/keu_donatur/data"); ?>"><i class="fa fa-circle-o"></i> Pendapatan Donatur </a></li>
          <li <?php if($judul=="pendapatanlainnya")echo "class='active'"; ?>><a href="<?php echo site_url("/pendapatan/lainnya/data"); ?>"><i class="fa fa-circle-o"></i> Pendaptan Lainnya  </a></li>
        </ul>
      </li>

      <li <?php if($judul=="pengeluarandepartemen")echo "style='background:#f4f4f5'";
        else if($judul=="pengeluaranlainnya")echo "style='background:#f4f4f5'";?> class="treeview">
          <a href="#">
            <i class="fa fa-cart-arrow-down"></i>
            <span>Pengeluaran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
          <li <?php if($judul=="pengeluarandepartemen")echo "class='active'"; ?>><a href="<?php echo site_url("/pengeluaran/keu_departemen/data"); ?>"><i class="fa fa-circle-o"></i> Pengeluaran Departemen </a></li>
          <li <?php if($judul=="pengeluaranlainnya")echo "class='active'"; ?>><a href="<?php echo site_url("/pengeluaran/lainnya/data"); ?>"><i class="fa fa-circle-o"></i> Pengeluaran Lainnya </a></li>
        </ul>
      </li>

      <li <?php if($judul=="keu_departemen")echo "style='background:#f4f4f5'";
        elseif($judul=="progjadepartemen")echo "style='background:#f4f4f5'";?> class="treeview">
          <a href="#">
            <i class="fa fa-university"></i>
            <span>Departemen</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
          <li <?php if($judul=="keu_departemen")echo "class='active'"; ?>><a href="<?php echo site_url("/departemen/daftardepartemen/data"); ?>"><i class="fa fa-circle-o"></i> Departemen </a></li>
          <li <?php if($judul=="progjadepartemen")echo "class='active'"; ?>><a href="<?php echo site_url("/departemen/progjadepartemen/data"); ?>"><i class="fa fa-circle-o"></i> Program Kerja Departemen </a></li>
          <li <?php if($judul=="timelineprogja")echo "class='active'"; ?>><a href="<?php echo site_url("/departemen/timelineprogja/data"); ?>"><i class="fa fa-circle-o"></i> Timeline Program Kerja</a></li>
        </ul>
      </li>

      <li <?php if($judul=="keu_donatur")echo "style='background:#f4f4f5'";?> class="treeview">
          <a href="#">
            <i class="fa fa-address-book"></i>
            <span>Donatur</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
          <li <?php if($judul=="keu_donatur")echo "class='active'"; ?>><a href="<?php echo site_url("/donatur/daftardonatur/data"); ?>"><i class="fa fa-circle-o"></i> Daftar Donatur </a></li>
        </ul>
      </li>

      <li <?php if($judul=="tahunkepengurusan")echo "style='background:#f4f4f5'";?> class="treeview">
          <a href="#">
            <i class="fa fa-calendar"></i>
            <span>Kepengurusan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
          <li <?php if($judul=="tahunkepengurusan")echo "class='active'"; ?>><a href="<?php echo site_url("/kepengurusan/thnkepengurusan/data"); ?>"><i class="fa fa-circle-o"></i> Tahun Kepengurusan </a></li>
        </ul>
      </li>

      <li <?php if($judul=="cetak")echo "style='background:#f4f4f5'";?> class="treeview">
          <a href="#">
            <i class="fa fa-print"></i>
            <span>Cetak</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
          <li <?php if($judul=="cetak")echo "class='active'"; ?>><a href="<?php echo site_url("/cetak/index/data"); ?>"><i class="fa fa-circle-o"></i> Cetak Laporan </a></li>
        </ul>
      </li>

      <li <?php if($judul=="akun")echo"style='background:#f4f4f5'";
      else if($judul=="org")echo"style='background:#f4f4f5'";
      else if ($judul =="iuranpengurus") ?> class="treeview" >
            <a href="#">
              <i class="glyphicon glyphicon-cog"></i>
              <span>Pengaturan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

        <ul class="treeview-menu">
          <li <?php if($judul=="akun")echo "class='active'"; ?>><a href="<?php echo site_url("/pengaturan/akun/infoakun"); ?>"><i class="glyphicon glyphicon-one_admin"></i> Akun</a></li>
          <li <?php if($judul=="org")echo "class='active'";?>><a href="<?php echo site_url("/pengaturan/org/infoorg"); ?>"><i class="fa fa-group"></i> Organisasi</a></li>
          <li <?php if($judul=="settingiuranpengurus")echo "class='active'";?>><a href="<?php echo site_url("/pengaturan/iuranpengurus/infoiuran"); ?>"><i class="fa fa-book"></i> Iuran Pengurus </a></li>
          </li>
        </ul>


        <li>
              <a data-toggle="modal" data-target="#keluar" href="#">
                <i class="glyphicon glyphicon-log-out"></i> <span>Keluar</span>
              </a>
        </li>

    </ul>

  </section>
  <!-- /.sidebar -->
</aside>
