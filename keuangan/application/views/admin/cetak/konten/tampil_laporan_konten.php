<table id="example1" class="table table-bordered table-striped">
  <thead style='background:#008080;color:#fff;'>
  <tr>
    <th><center>No</center></th>
    <th><center>Tanggal</center></th>
    <th><center>Keterangan</center></th>
    <th><center>Pendapatan</center></th>
    <th><center>Pengeluaran</center></th>
  </tr>
  </thead>
  <tbody>
<?php
include"function.php";
$nomor = 1;
if ($laporan == NULL) {
  
}
else{
foreach ($laporan as $row) { ?>
  <tr style="font-size:14px">
    <td width="5%"><center><?php echo $nomor; ?></center></td>
    <td><?php echo tgl_indo($row->tanggal); ?></td>
    <td><?php echo $row->keterangan; ?></td>
    <td><?php if($row->pendapatan == 0)echo ''; else echo $row->pendapatan; ?></td>
    <td><?php if($row->pengeluaran == 0)echo ''; else echo $row->pengeluaran; ?></td>
  </tr>
<?php $nomor++; }?>
  </tbody>
</table>
<?php } ?>

<!-- DataTables -->
<script src="<?php echo base_url('assets/template/back')?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/template/back')?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
