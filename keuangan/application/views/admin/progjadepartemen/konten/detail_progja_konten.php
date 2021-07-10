<!-- Left side column. contains the logo and sidebar -->
<?php include"function.php"; ?>
<?php foreach ($data_progja as $row) { ?>
  <!-- FILE MODALS -->
  <!-- START Modal Hapus Progja -->
  <div class="modal fade" id="hapusprogja_<?php echo $row->id_progja; ?>">
    <div class="modal-dialog modal-sm">
  	<div class="modal-content">
  	  <div class="modal-header">
  		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  		  <span aria-hidden="true">&times;</span></button>
  		<h4 class="modal-title">Hapus Program Kerja</h4>
  	  </div>
  	  <div class="modal-body">
  		<p>Anda ingin menghapus Program Kerja ini?<br>Tindakan ini tidak dapat dibatalkan!</p>
  		<a href="<?php echo base_url(); ?>departemen/progjadepartemen/hapusprogja_aksi/?id=<?php echo $row->id_progja;?>&id_b=<?php echo $row->id_departemen; ?>" class="btn btn-block btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
  		<button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
  	  </div>
  	</div>
    </div>
  </div>
  <!-- END Modal Hapus Progja -->
  <?php } ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Program Kerja
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li><a href="<?php echo base_url(); ?>departemen/progjadepartemen/data"></i> Program Kerja</a></li>
      <li class="active">Detail Program Kerja</li>
    </ol>
  </section>
  <?php foreach ($data_progja as $r) {
    $keu_departemen = $r->nama_departemen;
    $id_departemen = $r->id_departemen;
  } ?>
  <section class="content">

     <!-- Main content -->
    <?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Detail Program Kerja Departemen <?php echo $keu_departemen; ?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
          <a href="<?php echo base_url();?>departemen/progjadepartemen/tambah/?id=<?php echo $_GET['id']; ?>" title="Tambah" class="btn btn-success btn-m"><i class="fa fa-plus"></i> Tambah Program Kerja</a><p></p>
        <table id="example1" class="table table-bordered table-striped">
      <thead style='background:#008080;color:#fff;'>
        <tr>
          <th><center>No</center></th>
          <th><center>Program Kerja</center></th>
          <th><center>Estimasi Biaya</center></th>
          <th><center>Aksi</center></th>
        </tr>
      </thead>
      <tbody>


    <?php
    $nomor = 1;
    foreach ($data_progja as $r) {
      if($r->nama_progja != NULL){
      ?>
          <tr style="font-size:13px">
            <td  width="5%"><center><?php echo $nomor; ?></center></td>
            <td><center><?php echo $r->nama_progja; ?></center></td>
            <td><center><?php echo rupiah($r->estimasi_biaya); ?></center></td>
            <td><center>
              <a href="<?php echo base_url(); ?>departemen/progjadepartemen/edit/?id=<?php echo $r->id_progja;?>&keu_departemen=<?php echo $_GET['id']; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>              <a data-toggle="modal" data-target="#hapusprogja_<?php echo $r->id_progja;?>" title="Hapus Progja" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
            </center></td>
          </tr>
          <?php $nomor++;}} ?>
          </tbody>

        </table>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      <a href="<?php echo base_url(); ?>departemen/progjadepartemen/data" title="Kembali" class="btn btn-default"></i> Kembali</a>
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

var rupiah2 = document.getElementById("rupiah2");
rupiah2.addEventListener("keyup", function(e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  rupiah2.value = formatRupiah(this.value, "Rp. ");
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
