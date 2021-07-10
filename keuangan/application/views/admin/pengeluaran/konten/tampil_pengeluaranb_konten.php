<table id="example1" class="table table-bordered table-striped">
  <thead style='background:#008080;color:#fff;'>
    <tr>
      <th><center>No</center></th>
      <th><center>Departemen</center></th>
      <th><center>Program Kerja</center></th>
      <th><center>Estimasi Biaya</center></th>
      <th><center>Minggu</th>
      <th><center>Tanggal Pelaksanaan</center></th>
      <th><center>Aksi</center></th>
    </tr>
  </thead>
  <tbody>
<?php
include"function.php";
$nomor = 1;
if($pengeluaran_departemen == NULL){

}
else{
foreach ($pengeluaran_departemen as $row) { ?>
  <tr style="font-size:14px">
    <td width="5%"><center><?php echo $nomor; ?></center></td>
    <td><?php echo $row->nama_departemen; ?></td>
    <td width="20%"><?php echo $row->nama_progja; ?></td>
    <td width="20%"><center><?php echo $row->estimasi_biaya; ?></center></td>
    <td><center><?php echo minggu($row->minggu); ?></center></td>
    <td><center><input type='date' id='tanggal' style='width:200px;' min=<?= $tglawal ?> max=<?= $tglakhir ?>  <?php if($row->tanggal_terlaksana != NULL) echo "value=".$row->tanggal_terlaksana." disabled"; else echo "value=".date('Y-m-d'); ?> ></center></td>
    <td width="5%">
      <center>
        <?php if($row->status == 'N')echo "<button type='text' class='btn btn-success' id='add' size='5' onclick='add($row->id_timeline_progja);'>Tambah</button>";
              else echo "<button type='text' class='btn btn-danger' id='cancel' size='5' onclick='cancel($row->id_timeline_progja);'>Batal</button>"; ?>
      </center>
    </td>
  </tr>
<?php $nomor++; }
?>
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
