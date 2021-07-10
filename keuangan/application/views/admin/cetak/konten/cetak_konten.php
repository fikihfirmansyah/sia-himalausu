<!-- Left side column. contains the logo and sidebar -->
<?php
include "function.php";  // FILE Function
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Cetak Laporan
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li class="active">Cetak Laporan</li>
    </ol>
  </section>
  <!-- Main content -->
    <section class="content">
      <div class="col-md-3">

    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Masukkan Waktu</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body" style="overflow-x:auto;">
          <form method="POST" class="form-horizontal">
            <div class='form-group'>
                  <label class='col-sm-4 control-label'>Bulan :</label>
                    <div class='col-sm-7'>
                      <select name='o_bulan' class='form-control' id="bulan">
                        <option value="0" selected>-Pilih Bulan-</option>";
                          <?php for($i =1;$i<=12;$i++){?>
                              <option value="<?php echo $i ?>"><?php echo bulan($i); ?></option>";
                          <?php } ?>
                      </select>
                    </div>
            </div>
            <div class='form-group'>
                  <label class='col-sm-4 control-label'>Tahun :</label>
                    <div class='col-sm-7'>
                      <select name='o_tahun' class='form-control' id="tahun" >
                        <option value="0" selected>-Pilih Tahun-</option>";
                        <?php for($i=$mulai;$i<=$akhir;$i++){?>
                        <option value="<?=$i?>"><?=$i?></option>"';
                        <?php } ?>
                      </select>
                    </div>
            </div>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-9">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Cetak Laporan</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
        <div id="link"> </div><br>
        <div id="load">

        </div>
  </div>
</div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>
$(document).ready(function() {
      //jika data sudah siap maka akan dijalankan
      tampil_laporan();
      link_laporan();
      $("#bulan").change(function(){
        // // ini dijalankan ketika ada event dari combo box
        tampil_laporan();
        link_laporan();
      });
      $("#tahun").change(function(){
        // // ini dijalankan ketika ada event dari combo box
        tampil_laporan();
        link_laporan();
    });
    });

    function tampil_laporan() {
      var bulan = $("#bulan").val();
      var tahun = $("#tahun").val();
      $.ajax({
        url : "<?= base_url('cetak/index/load_data') ?>",
        async : false,
        data: "bulan=" + bulan +"& tahun=" + tahun,
        success:function(data) {
          $("#load").html(data);
        }
      });
    }

    function link_laporan() {
      var bulan = $("#bulan").val();
      var tahun = $("#tahun").val();
      $.ajax({
        url : "<?= base_url('cetak/index/link_laporan') ?>",
        data: "bulan=" + bulan +"& tahun=" + tahun,
        success:function(data) {
          $("#link").html(data);
        }
      });
    }

</script>
