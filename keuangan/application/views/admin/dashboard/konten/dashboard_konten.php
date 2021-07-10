  <!-- Left side column. contains the logo and sidebar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <?php include 'function.php'; ?>
    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-md-12">

      <?php
      if($tahunkepengurusan > 0){
          include('box_konten.php');
          include('pendapatan_konten.php');
          include('pengeluaran_konten.php');
          include('grafik_konten.php');
          }
      else{?>
        <div class="col-md-12">
        <div class="box box-info">
        <div class="box-header with-border">
        <h3 class="box-title">DASHBOARD</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
        </div>
        <!-- /.box-header --> 
        <div class="box-body" style="overflow-x:auto;" >
          <h2>Tidak Ada Tahun Kepengurusan Yang Aktif</h2>
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
        </div>
        <!-- /.box -->
        </div>


      <?php } ?>

<!-- /.table-responsive -->
<!-- /.box-body -->
<!-- /.box-footer -->


      <!-- /.row -->


        <!-- /.col -->

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
