<!-- Left side column. contains the logo and sidebar -->
<?php include"function.php"; ?>
<?php foreach ($riwayat_iuran as $row) { ?>
  <!-- FILE MODALS -->
  <!-- START Modal Edit Riwayat Iuran -->
  <div class="modal fade" id="editriwayat_<?php echo $row->id_rpi; ?>">
    <div class="modal-dialog modal-lg">
  	<div class="modal-content">
  	  <div class="modal-header">
  		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  		  <span aria-hidden="true">&times;</span></button>
  		<h4 class="modal-title">Edit Riwayat Iuran</h4>
  	  </div>
  	  <div class="modal-body">
        <form method="POST" action="<?php echo base_url(); ?>pengurus/iuranpengurus/editriwayat_aksi/?id=<?php echo $row->id_rpi; ?>">

          <table class="table table-bordered">
            <input type="text" name="id" value=<?php echo $row->id_pengurus; ?> hidden>
      <tr>
                <td width="30%">NIM</td>
                <td><input type="text" class="form-control" name="t_nim" value = <?php echo $row->nim; ?> readonly></td>
      </tr>
      <tr>
                <td width="30%">Tanggal</td>
                <td><input type="date" class="form-control" name="t_tanggal" min=<?= $tglawal;?> max=<?= $tglakhir;?> value=<?php echo $row->tanggal; ?>></td>
      </tr>
      <tr>
                <td width="30%">Jumlah</td>
                <td><input type="text" class="form-control" id="rupiah" name="t_jumlah" value="<?php echo rupiah($row->jumlah); ?>"></td>
      </tr>
      </table>

          <a data-dismiss="modal" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
          <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
        </form>
  	  </div>
  	</div>
    </div>
  </div>

  <!-- END Modal Edit Riwayat Iuran -->
  <!-- START Modal Hapus Riwyat Iuran -->
  <div class="modal fade" id="hapusriwayat_<?php echo $row->id_rpi; ?>">
    <div class="modal-dialog modal-sm">
  	<div class="modal-content">
  	  <div class="modal-header">
  		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  		  <span aria-hidden="true">&times;</span></button>
  		<h4 class="modal-title">Hapus Riwayat Iuran</h4>
  	  </div>
  	  <div class="modal-body">
  		<p>Anda ingin menghapus Riwayat Iuran ini?<br>Tindakan ini tidak dapat dibatalkan!</p>
  		<a href="<?php echo base_url(); ?>pengurus/iuranpengurus/hapusriwayat_aksi/?id=<?php echo $row->id_rpi;?>&nim=<?php echo $row->nim; ?>" class="btn btn-block btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
  		<button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
  	  </div>
  	</div>
    </div>
  </div>
  <!-- END Modal Hapus Riwayat Iuran -->
  <?php } ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengurus
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li class="active">Detail Iuran Pengurus</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">


<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Detail Iuran Pengurus <?php echo $org; ?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
        <?php foreach ($data_pengurus as $r) {
          $nama = $r->nama;
          $nim = $r->nim;
          $keu_departemen = $r->nama_departemen;
          $keu_amanah = $r->nama_amanah;
        } ?>
        <h2><center>Riwayat Pembayaran Iuran</center></h2>
        <table>
        <tr>
        <td>NIM </td><td>: <?php echo $nim; ?></td>
        </tr>
        <tr>
        <td>Nama </td><td>: <?php echo $nama; ?></td>
        </tr>
        <tr>
        <td>Amanah</td><td>: <?php echo $keu_amanah.' '.$keu_departemen.' '.$org;?> </td>
        </tr>
        <table>
          <br>
    <table id=example1 class="table table-bordered table-striped">
  <thead style='background:#008080;color:#fff;'>
    <tr>
      <th><center>Nomor</center></th>
      <th><center>Tanggal</center></th>
      <th><center>Jumlah Pembayaran</center></th>
      <th><center>Aksi</center></th>
    </tr>
  </thead>
  <tbody>

<?php
$nomor = 1;
?>
<?php foreach ($riwayat_iuran as $row) {?>
  <?php if($row->jumlah != 0){ ?>
      <tr style="font-size:13px">
        <td width="5%"><center><?php echo $nomor; ?></center></td>
        <td><center><?php echo tgl_indo($row->tanggal); ?></center></td>
        <td><center><?php echo rupiah($row->jumlah); ?></center></td>
        <td><center>
          <a data-toggle="modal" data-target="#editriwayat_<?php echo $row->id_rpi;?>" title="Edit Riwayat" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
          <a data-toggle="modal" data-target="#hapusriwayat_<?php echo $row->id_rpi;?>" title="Hapus Riwayat" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
        </center></td>
      </tr>
<?php $nomor++;}} ?>
      </tbody>
    </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      <a href="<?php echo base_url(); ?>pengurus/iuranpengurus/data" title="Kembali" class="btn btn-default"></i> Kembali</a>
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
  </div>
</div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>
var rupiah = document.getElementById("rupiah");
rupiah.addEventListener("keyup", function(e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  rupiah.value = formatRupiah(this.value, "Rp. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}
</script>
