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
      <li><a href="<?php echo base_url(); ?>pengurus/daftarpengurus/data"><i class="fa fa-folder-open"></i> Pengurus</a></li>
      <li class="active"><i class="fa fa-folder-open"></i> Edit Pengurus</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Pengurus</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>



      <div class="col-md-12 box-body">
  <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>
  <?php
  foreach ($data_pengurus as $row)
  {
  ?>
  <form method="POST" class="form-horizontal" action="<?php echo base_url(); ?>pengurus/daftarpengurus/editpengurus_aksi/?>">
  <input type="text" name="id" value="<?php echo $row->id_pengurus;?>" hidden>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>NIM :</label>
            <div class='col-sm-8'>
              <input type="text" class="form-control" name="t_nim" value="<?php echo $row->nim; ?>">
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Nama :</label>
            <div class='col-sm-8'>
              <input type="text" class="form-control" name="t_nama" value="<?php echo $row->nama; ?>">
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Amanah :</label>
            <div class='col-sm-8'>
              <select name='o_amanah' class='form-control' required>
                  <?php foreach($keu_amanah as $r):?>
                    <option value="<?=$r->id_amanah?>" <?php if($r->id_amanah==$row->keu_amanah) echo"selected" ;?>><?=$r->nama_amanah?></option>";
                  <?php endforeach; ?>
              </select>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Departemen :</label>
            <div class='col-sm-8'>
              <select name='o_departemen' class='form-control' required>
                    <?php if ($row->keu_departemen != NULL) {?>
                    <?php foreach($keu_departemen as $r){?>
                      <option value="<?=$r->id_departemen?>" <?php if($r->id_departemen==$row->keu_departemen) echo"selected" ;?>><?=$r->nama_departemen?></option>";
                    <?php }}else { ?>
                      <option value='-' selected> - </option>";
                      <?php foreach($keu_departemen as $r){?>
                        <option value="<?=$r->id_departemen?>"><?=$r->nama_departemen?></option>";
                    <?php }} ?>
              </select>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>NIM :</label>
            <div class='col-sm-8'>
              <a href="<?php echo base_url(); ?>pengurus/daftarpengurus/data" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
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
