<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Donatur</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li><a href="<?php echo base_url(); ?>donatur/daftardonatur/data"><i class="fa fa-folder-open"></i> Donatur</a></li>
      <li class="active"><i class="fa fa-folder-open"></i> Edit Donatur</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Donatur</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>



      <div class="col-md-12 box-body">
  <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>
  <?php
  foreach ($data_donatur as $row)
  {
  ?>
  <form method="POST" class="form-horizontal" action="<?php echo base_url(); ?>donatur/daftardonatur/editdonatur_aksi/?id=<?php echo $row->id_donatur ?>">

    <div class='form-group'>
          <label class='col-sm-3 control-label'>Nama :</label>
            <div class='col-sm-8'>
              <input type="text" class="form-control" name="t_nama" value="<?php echo $row->nama_donatur; ?>">
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Alamat :</label>
            <div class='col-sm-8'>
              <input type="text" class="form-control" name="t_alamat" value="<?php echo $row->alamat_donatur; ?>">
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'></label>
            <div class='col-sm-8'>
              <a href="<?php echo base_url(); ?>donatur/daftardonatur/data" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
            </div>
    </div>


<?php } ?>

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
