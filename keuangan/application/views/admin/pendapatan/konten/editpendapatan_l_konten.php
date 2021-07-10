<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Pendapatan Lainnya</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li><a href="<?php echo base_url(); ?>pendapatan/Lainnya/data"><i class="fa fa-folder-open"></i> Data Lainnya</a></li>
        <li class="active"><i class="fa fa-folder-open"></i> Edit Pendapatan Lainnya</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Pendapatan Lainnya <?php echo $org; ?></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>

      <div class="col-md-12 box-body">
  <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>
  <?php include"function.php"; ?> <!-- FILE Function -->
  <?php foreach ($keu_pendapatan_lainnya as $row) { ?>
  <form method="POST" class="form-horizontal" action="<?php echo base_url(); ?>pendapatan/lainnya/editpendapatan_aksi/?id=<?php echo $row->id_p_lainnya; ?>" onSubmit='return validasi(this)'>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Tanggal :</label>
            <div class='col-sm-8'>
            <input type="date" class="form-control" name="t_tanggal" min=<?= $tglawal ?> max=<?= $tglakhir ?> value = <?= $row->tanggal_pl; ?>>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Keterangan :</label>
            <div class='col-sm-8'>
              <textarea  class="form-control" name="t_keterangan"><?php echo $row->keterangan_pl; ?></textarea>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Jumlah :</label>
            <div class='col-sm-8'>
              <input type="text" class="form-control" id="rupiah" name="t_jumlah" placeholder="Masukkan Jumlah" value="<?php echo rupiah($row->jumlah_pl); ?>">
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'></label>
            <div class='col-sm-8'>
              <a href="<?php echo base_url(); ?>pendapatan/lainnya/data" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
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
  // Tambahkan 'Rp.' pada saat form di ketik
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

  // Editkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

</script>
<script type='text/javascript'>
    function validasi(form)
    {
      if(form.t_tanggal.value == "")
      {
        alert("Anda belum mengisi tanggal!");
        form.t_tanggal.focus();
        return (false);
      }
      else if (form.t_jumlah.value == "")
      {
        alert("Anda belum mengisi jumlah!");
        form.t_jumlah.focus();
        return (false);
      }
      return (true);
    }
</script>
