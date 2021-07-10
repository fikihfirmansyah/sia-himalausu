<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Tambah Program Kerja</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li><a href="<?php echo base_url(); ?>departemen/progjadepartemen/data"></i> Program Kerja</a></li>
      <li class="active">Tambah Program Kerja</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
  <?php foreach ($keu_departemen as $r ) {?>

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Program Kerja Departemen <?php echo $r->nama_departemen; ?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>

    <?php } ?>



      <div class="col-md-12 box-body">
  <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>

  <form method="POST" class="form-horizontal" action="<?php echo base_url(); ?>departemen/progjadepartemen/tambahprogja_aksi">
    <input type="text" name="id_departemen" value="<?php echo $_GET['id'];?>" hidden>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Program Kerja :</label>
            <div class='col-sm-8'>
              <input type="text" class="form-control" name="t_progja" placeholder="Masukkan Program Kerja" required>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Estimasi Biaya :</label>
            <div class='col-sm-8'>
                <input type="text" class="form-control"  id="rupiah" name="t_biaya" placeholder="Masukkan Estimasi Biaya" required>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'></label>
            <div class='col-sm-8'>
              <a href="<?php echo base_url(); ?>departemen/progjadepartemen/detail/?id=<?php echo $_GET['id'];?>" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
            </div>
    </div>

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
<script type='text/javascript'>
    $('form input[type=text]').on('change invalid', function() {
    var textfield = $(this).get(0);

    // hapus dulu pesan yang sudah ada
    textfield.setCustomValidity('');

    if (!textfield.validity.valid) {
      textfield.setCustomValidity('Tidak boleh kosong!');
    }
    });
    function validasi(form)
    {
      if(form.o_progja.value == "")
      {
        alert("Masukkan Program Kerja atau Tambahkan Terlebih Dahulu Program Kerja Departemen!");
        form.o_progja.focus();
        return (false);
      }
      else if (form.o_minggu.value == "")
      {
        alert("Anda Belum Mengisi Form Minggu!");
        form.o_minggu.focus();
        return (false);
      }
      else if (form.o_bulan.value == "")
      {
        alert("Anda Belum Mengisi Form Bulan!");
        form.o_bulan.focus();
        return (false);
      }
      return (true);
    }
</script>
