<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Departemen</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li><a href="<?php echo base_url(); ?>departemen/daftardepartemen/infodepartemen"><i class="fa fa-folder-open"></i> Data keu_departemen</a></li>
        <li class="active"><i class="fa fa-folder-open"></i> Tambah Departemen</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Departemen <?php echo $org; ?></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>



      <div class="col-md-12 box-body">
  <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>

  <form method="POST" class="form-horizontal" action="<?php echo base_url(); ?>departemen/daftardepartemen/tambahdepartemen_aksi">
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Nama Departemen :</label>
            <div class='col-sm-8'>
              <input type="text" class="form-control" name="t_departemen" placeholder="Masukkan Departemen">
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'></label>
            <div class='col-sm-8'>
              <a href="<?php echo base_url(); ?>departemen/daftardepartemen/data" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Tambah</button>
            </div>
    </div>

  </form>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">

      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->






  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
