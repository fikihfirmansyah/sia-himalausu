<!-- TABLE: PENGELUARAN -->
<div class="col-md-6">
<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Detail Pengerluaran</h3>

<div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
  </button>
  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
</div>
</div>
<!-- /.box-header -->
<div class="box-body" style="overflow-x:auto;">
<div class="table-responsive">
  <table class="table no-margin">
    <thead>
    <tr>
      <th>No</th>
      <th>Jenis Pengeluaran</th>
      <th>Jumlah</th>
    </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      foreach ($pengeluaran as $key => $value) {  ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $key; ?></td>
      <td><?php echo rupiah($value); ?></td>
    </tr>
<?php $no++;} ?>
    <tr><td colspan="3">&nbsp;</td></tr>
    </tbody>
  </table>

</div>
<!-- /.table-responsive -->
</div>
<!-- /.box-body -->
<!-- /.box-footer -->
</div>
<!-- /.box -->
</div>
<!-- /.col -->
