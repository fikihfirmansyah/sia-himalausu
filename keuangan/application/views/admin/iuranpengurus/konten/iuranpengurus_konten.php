<!-- Left side column. contains the logo and sidebar -->
<?php foreach ($iuranpengurus as $row) { ?>
  <!-- FILE MODALS -->
  <!-- START Modal Edit Pengeluaran -->
  <div class="modal fade" id="bayariuran_<?php echo $row->nim; ?>">
    <div class="modal-dialog modal-lg">
  	<div class="modal-content">
  	  <div class="modal-header">
  		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  		  <span aria-hidden="true">&times;</span></button>
  		<h4 class="modal-title">Bayar Iuran</h4>
  	  </div>


  	  <div class="modal-body">
        <form method="POST" action="<?php echo base_url(); ?>pengurus/iuranpengurus/bayariuran_aksi"onSubmit='return validasi(this)'>

          <table class="table table-bordered">
      <tr>
                <input type="text" name="id" value=<?php echo $row->id_pengurus; ?> hidden>
                <td width="30%">NIM</td>
                <td><input type="text" class="form-control" name="t_nim" value = <?php echo $row->nim; ?> readonly ></td>
      </tr>
      <tr>
                <td width="30%">Tanggal</td>
                <td><input type="date" class="form-control" name="t_tanggal" min=<?= $tglawal ?> max=<?= $tglakhir ?> value=<?= date('Y-m-d')?> ></td>
      </tr>
      <tr>
                <td width="30%">Jumlah</td>
                <td><input type="text" class="form-control" id="rupiah"   name="t_jumlah" placeholder="Masukkan Jumlah"></td>
      </tr>
      </table>

          <a data-dismiss="modal" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
          <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
        </form>
  	  </div>
  	</div>
    </div>
  </div>
<?php } ?>
  <!-- END Modal Hapus Pengeluaran -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengurus
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li class="active">Iuran Pengurus</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
<?php include"function.php"; ?>

    <div class="box box-success" >
      <div class="box-header with-border">
        <h3 class="box-title">Iuran Pengurus <?php echo $org; ?></h3>
        <div class="box-tools pull-right" > 
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
    <table id="example1" class="table table-bordered table-striped">
  <thead style='background:#008080;color:#fff;'>
    <tr>
      <th><center>No</center></th>
      <th><center>Nim</center></th>
      <th><center>Nama</center></th>
      <th><center>Bulan yang Telah Dibayarkan</center></th>
      <th><center>Keterangan</center></th>
      <th><center>Aksi</center></th>
    </tr>
  </thead>
  <tbody>



<?php
$nomor = 1;
foreach ($iuranpengurus as $row) { ?>
  <?php
    $jumlah = $row->jumlah;
    $tgl_now = date("Y-m-d");
    foreach ($keu_setting as $r) {
    $keu_iuran_pengurus = $r->keu_iuran_pengurus;
    $tgl_awal = $r->tanggal_awal;
    // Menambah bulan ini + semua bulan pada tahun sebelumnya
    $numBulan = 1 + (date("Y",strtotime($tgl_now))-date("Y",strtotime($tgl_awal)))*12;

    // menghitung selisih bulan
    $numBulan += date("m",strtotime($tgl_now))-date("m",strtotime($tgl_awal));
    if ($keu_iuran_pengurus > 0){
      $bulan_yg_lunas = $jumlah / $keu_iuran_pengurus;
    }
    else {
      $bulan_yg_lunas = $numBulan;
    }
    $jumlah_lunas = $jumlah - $keu_iuran_pengurus*$numBulan;
    if($tgl_awal <= date('Y-m-d') ){
      if($numBulan == $bulan_yg_lunas){
        $keterangan = "Sudah Melunasi Pembayaran Untuk Bulan Ini";
      }
      else if($numBulan > $bulan_yg_lunas){
        $keterangan = "Belum Membayar Iuran Sebesar ".rupiah($jumlah_lunas*-1);
      }
      else if($numBulan < $bulan_yg_lunas){
        $keterangan = "Lunas Sampai ".floor($bulan_yg_lunas - $numBulan)." Bulan Kedepan";
      }
    }
    else {
      $keterangan = "-";
    }
    $bulan_udah = $bulan_yg_lunas - 1;
    if($jumlah >= $keu_iuran_pengurus){
    $tgllunas = date('Y-m-d',strtotime('+'.$bulan_udah.'months',strtotime($tgl_awal)));
    }
    else{
      $tgllunas = "-";
    }

  }
  ?>
      <tr style="font-size:13px">
        <td  width="5%"><center><?php echo $nomor; ?></center></td>
        <td><?php echo $row->nim; ?></td>
        <td><?php echo $row->nama; ?></td>
        <td><center>
          <?php
          if($tgllunas != '-'){
            if($tgllunas == $tgl_awal){
              echo bulan($tgllunas);
            } else {
              echo bulan($tgl_awal)." - ".bulan($tgllunas);
            }
          }
          else {
            echo $tgllunas;
          }
          ?>
        </center></td>
        <td><center><?php echo $keterangan;?></center></td>
      <td>
        <a data-toggle="modal" data-target="#bayariuran_<?php echo $row->nim;?>" title="Bayar Iuran" class="btn btn-success btn-sm"><i class="fa fa-money"></i> Bayar Iuran</a>
        <a href="<?php echo base_url(); ?>pengurus/iuranpengurus/detail/?nim=<?php echo $row->nim ;?>" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
      </td>
      </tr>
<?php $nomor++;} ?>
      </tbody>
    </table>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">

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
