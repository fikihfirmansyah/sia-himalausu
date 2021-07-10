<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Pendapatan Donatur</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li><a href="<?php echo base_url(); ?>pendapatan/keu_donatur/data"><i class="fa fa-folder-open"></i> Data Donatur</a></li>
        <li class="active"><i class="fa fa-folder-open"></i> Edit Pendapatan Donatur</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Pendapatan Donatur <?php echo $org; ?></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>

      <div class="col-md-12 box-body">
  <?php include "function.php"; ?> <!-- FILE Function -->
  <?php foreach ($keu_pendapatan_donatur as $row) { ?>
  <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>

  <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>pendapatan/keu_donatur/editpendapatan_aksi/?id=<?php echo $row->id_p_donatur; ?>" onSubmit='return validasi(this)'>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Nama Donatur:</label>
            <div class='col-sm-8'>
              <select name='o_donatur' class='form-control' required>
                  <?php foreach($keu_donatur as $r):?>
                    <option value="<?=$r->id_donatur?>" <?php if($row->id_donatur==$r->id_donatur) echo 'selected'; ?>><?=$r->nama_donatur?></option>";
                  <?php endforeach; ?>
              </select>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Tanggal :</label>
            <div class='col-sm-8'>
              <input type="date" class="form-control" name="t_tanggal" min=<?= $tglawal ?> max=<?= $tglakhir ?> value = <?= $row->tanggal_pemberian; ?>>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Jumlah :</label>
            <div class='col-sm-8'>
              <input type="text" class="form-control" id="rupiah" name="t_jumlah" placeholder="Masukkan Jumlah" value="<?php echo rupiah($row->jumlah_pemberian); ?>">
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Resi Pembayaran :</label>
            <div class='col-sm-8'>
              <input type="file" class="form-control" name="fupload" value="<?php echo $row->resi_donatur; ?>">
              <hr style='margin:3px'>
              <span style="color:red"> Upload File Jpg/Jpeg/Png Maks.1 MB</span>
              &nbsp;&nbsp; || Resi saat ini :
              <a href="<?php echo base_url(); ?>assets/image/resi_donatur/<?php echo $row->resi_donatur ;?>">
                <?php echo $row->resi_donatur ;?>
              </a>
            </div>
      </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'></label>
            <div class='col-sm-8'>
              <a href="<?php echo base_url(); ?>pendapatan/keu_donatur/data" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Edit</button>
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
  // Editkan 'Rp.' pada saat form di ketik
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
