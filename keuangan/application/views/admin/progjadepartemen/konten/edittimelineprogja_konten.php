<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Timeline Program Kerja</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li><a href="<?php echo base_url(); ?>departemen/timelineprogja/lihat/?id=<?php echo $_GET['keu_departemen']; ?>"><i class="fa fa-folder-open"></i> Timeline Program Kerja</a></li>
      <li class="active"><i class="fa fa-folder-open"></i> Edit Timeline Program Kerja</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
<?php include"function.php"; ?>
<?php foreach ($keu_departemen as $r ) {?>

    <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Timeline Program Kerja Departemen <?php echo $r->nama_departemen; ?></h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div>

  <?php } ?>



      <div class="col-md-12 box-body">
  <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>
  <?php
  foreach ($keu_timeline_progja as $row)
  {
  ?>
  <form method="POST" class="form-horizontal" action="<?php echo base_url(); ?>departemen/timelineprogja/edittimeline_aksi/?id=<?php echo $row->id_timeline_progja; ?>">
    <input type="hidden" name="id_departemen" value="<?php echo $_GET['keu_departemen']; ?>">
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Program Kerja :</label>
            <div class='col-sm-8'>
              <select name='o_progja' class='form-control' required>
                <?php foreach($progja as $r):?>
                  <option value="<?=$r->id_progja?>" <?php if($r->id_progja==$row->id_progja) echo"selected" ;?>><?=$r->nama_progja?></option>
                <?php endforeach; ?>
              </select>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Minggu :</label>
            <div class='col-sm-8'>
              <select name='o_minggu' class='form-control' required>
                  <?php for($i=1;$i<=4;$i++){?>
                    <option value="<?=$i?>" <?php if($i==$row->minggu) echo"selected" ;?>><?=minggu($i)?></option>";
                  <?php } ?>
              </select>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Bulan :</label>
            <div class='col-sm-8'>
              <select name='o_bulan' class='form-control' required>
                  <?php for($i=1;$i<=12;$i++){?>
                <option value="<?=$i?>" <?php if($i==$row->bulan) echo"selected" ;?>><?=bulan($i)?></option>";
                  <?php } ?>
              </select>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Tahun :</label>
            <div class='col-sm-8'>
              <input type="text" class="form-control" name="t_tahun" value="<?php echo $row->tahun; ?>">
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'></label>
            <div class='col-sm-8'>
              <a href="<?php echo base_url(); ?>departemen/timelineprogja/lihat/?id=<?php echo $_GET['keu_departemen']; ?>" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
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
