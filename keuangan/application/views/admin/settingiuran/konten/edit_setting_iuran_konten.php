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
        <li><a href="<?php echo base_url(); ?>pengaturan/iuranpengurus/infoiuran"><i class="fa fa-folder-open"></i> Iuran Pengurus</a></li>
      <li class="active"><i class="fa fa-folder-open"></i> Edit Setting Iuran Pengurus</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
<?php include"function.php" ?>

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Setting Iuran Pengurus</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>



      <div class="col-md-12 box-body">
  <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>
  <?php foreach ($keu_setting as $row ) {?>


  <form method="POST" class = "form-horizontal" action="<?php echo base_url(); ?>pengaturan/iuranpengurus/do_update" enctype='multipart/form-data' role= "form">
    <input type="text" name="id_kepengurusan" value="<?php echo $row->thnkepengurusan_id;?>" hidden>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Tanggal Awal Pembayaran :</label>
            <div class='col-sm-8'>
              <input type="date" class="form-control" name="date" min=<?= $tglawal ?> max=<?= $tglakhir ?> value=<?= $row->tanggal_awal; ?> >
            </div>
      </div>
      <div class='form-group'>
            <label class='col-sm-3 control-label'>Besar Iuran Perbulan :</label>
              <div class='col-sm-8'>
                <input type="text" class="form-control" name="besariuran" id="rupiah" value="<?php echo rupiah($row->keu_iuran_pengurus); ?>" >
              </div>
      </div>
      <div class='form-group'>
            <label class='col-sm-3 control-label'>Saldo Kas :</label>
              <div class='col-sm-8'>
                <input type="text" class="form-control" name="saldokas" id="rupiah2" value="<?php echo rupiah($row->saldo_kas); ?>" >
              </div>
        </div>


        <div class='form-group'>
              <label class='col-sm-3 control-label'>
              </label>
                <div class='col-sm-8'>
                  <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-saved"></i> Perbarui</button>
                  <a href="<?php echo base_url(); ?>pengaturan/iuranpengurus/infoiuran" title="Kembali" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> Batal</a>
                </div>
          </div>




  </form>
  <?php } ?>
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
