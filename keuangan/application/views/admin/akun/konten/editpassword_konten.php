<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Pengaturan</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li><a href="<?php echo base_url(); ?>pengaturan/akun/infoakun"><i class="fa fa-folder-open"></i> Akun</a></li>
      <li class="active"><i class="fa fa-folder-open"></i> Edit Password</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Password</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>



      <div class="col-md-12 box-body">
  <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>

  <form method="POST" class = "form-horizontal" action="<?php echo base_url(); ?>pengaturan/akun/validasi_ep" enctype='multipart/form-data' role= "form">
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Password Lama :</label>
            <div class='col-sm-8'>
              <input type="password" class="form-control" name="password_lama" placeholder="Password Lama">
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Password Baru :</label>
            <div class='col-sm-8'>
              <input type="password" class="form-control" name="password_baru" placeholder="Password Baru">
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Konfirmasi Password Baru :</label>
            <div class='col-sm-8'>
              <input type="password" class="form-control" name="konfirmasi_password" placeholder="Konfirmasi Password Baru">
            </div>
      </div>
      <div class='form-group'>
            <label class='col-sm-3 control-label'>
            </label>
              <div class='col-sm-8'>
                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-saved"></i> Simpan</button>
                <a href="<?php echo base_url(); ?>pengaturan/akun/infoakun" title="Kembali" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> Batal</a>
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
