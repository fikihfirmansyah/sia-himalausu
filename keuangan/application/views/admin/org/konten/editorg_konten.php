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
      <li class="active"><i class="fa fa-folder-open"></i> Edit Organisasi</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Organisasi</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>



      <div class="col-md-12 box-body">
  <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>

  <form method="POST" class = "form-horizontal" action="<?php echo base_url(); ?>pengaturan/org/do_update" enctype='multipart/form-data' role= "form">
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Nama Organisasi :</label>
            <div class='col-sm-8'>
              <input type="text" class="form-control" name="org" value="<?php echo $org; ?>" >
            </div>
      </div>
      <div class='form-group'>
            <label class='col-sm-3 control-label'>Universitas :</label>
              <div class='col-sm-8'>
                <input type="text" class="form-control" name="keu_univ" value="<?php echo $keu_univ; ?>" >
              </div>
        </div>
        <div class='form-group'>
              <label class='col-sm-3 control-label'>Logo Organisasi :</label>
                <div class='col-sm-8'>
                  <input type="file" class="form-control" name="fupload" value="<?php echo $logo_org; ?>">
                <hr style='margin:3px'>Logo Saat ini : <img src="<?php echo base_url(); ?>assets/image/<?php echo $logo_org ;?>" alt="Logo Organisasi" width=30>
                </div>
          </div>
          <div class='form-group'>
                <label class='col-sm-3 control-label'>
                </label>
                  <div class='col-sm-8'>
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-saved"></i> Perbarui</button>
                    <a href="<?php echo base_url(); ?>pengaturan/org/infoorg" title="Kembali" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> Batal</a>
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
