<!-- Left side column. contains the logo and sidebar -->
<?php
include "function.php";  // FILE Function
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengeluaran
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li class="active">Pengeluaran Departemen</li>
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
                          <?php foreach($tahun as $r):?>
                        <option value="<?=$r->tahun?>"><?=$r->tahun?></option>";
                          <?php endforeach; ?>
                      </select>
                    </div>
            </div>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Pengeluaran Departemen</h3>
        <div id ="alert"></div>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
        <div id="load"></div>
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
      pengeluaran_departemen();
      $("#bulan").change(function(){
        // // ini dijalankan ketika ada event dari combo box
        pengeluaran_departemen();
      });
      $("#tahun").change(function(){
        // // ini dijalankan ketika ada event dari combo box
        pengeluaran_departemen();
    });
    });

    function pengeluaran_departemen() {
      var bulan = $("#bulan").val();
      var tahun = $("#tahun").val();
      $.ajax({
        url : "<?= base_url('pengeluaran/keu_departemen/load_data') ?>",
        data: "bulan=" + bulan +"& tahun=" + tahun,
        success:function(data) {
          $("#load").html(data);
        }
      });
    }

    function add(id){
      var tanggal = $("#tanggal").val();
      if(tanggal != ""){
        $.ajax({
          url : "<?= base_url('pengeluaran/keu_departemen/edit_aksi') ?>",
          data: "id_timeline=" + id +"& status=" + 'Y'+"& tanggal=" + tanggal,
          success:function(data) {
            pengeluaran_departemen();
          }
        });
      }
      else{
        alert('Isi Tanggal Pelaksanaan Kegiatan');
      }
    }
    function cancel(id){
      $.ajax({
        url : "<?= base_url('pengeluaran/keu_departemen/edit_aksi') ?>",
        data: "id_timeline=" + id +"& status=" + 'N'+"& tanggal=" + '',
        success:function(data) {
          pengeluaran_departemen();
        }
      });
    }
</script>
