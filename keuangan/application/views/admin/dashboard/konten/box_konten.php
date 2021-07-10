<div class="row">
  <div class="col-md-12">
    <div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">
      <?php foreach ($jml_pengurus as $row ) {?>
        <h3><?php echo $row->jmlpengurus; ?></h3>
      <?php } ?>

      <p>Pengurus Terdaftar</p>
    </div>
    <div class="icon">
      <i class="ion ion-person"></i>
    </div>
    <a href="<?php echo base_url(); ?>pengurus/daftarpengurus/data" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-red">
<div class="inner">
  <?php foreach ($jml_donatur as $row ) {?>
    <h3><?php echo $row->jmldonatur; ?></h3>
  <?php } ?>

  <p>Donatur Terdaftar</p>
</div>
<div class="icon">
  <i class="ion ion-person"></i>
</div>
<a href="<?php echo base_url(); ?>donatur/daftardonatur/data" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<div class="col-lg-6 col-xs-12">
<!-- small box -->
<div class="small-box bg-green">
<div class="inner">
<h3><?php echo rupiah($kas); ?></h3>
<p>Saldo</p>
</div>
<div class="icon">
<i class="ion ion-cash"></i>
</div>
<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

</div>
<!-- /.col -->
</div>
