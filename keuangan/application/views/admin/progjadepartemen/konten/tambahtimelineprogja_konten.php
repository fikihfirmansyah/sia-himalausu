<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Timeline Program Kerja</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li><a href="<?php echo base_url(); ?>departemen/timelineprogja/lihat/?id=<?php echo $_GET['id']; ?>"><i class="fa fa-folder-open"></i> Timeline Program Kerja</a></li>
      <li class="active"><i class="fa fa-folder-open"></i> Tambah Timeline Program Kerja</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
<?php include"function.php" ?>

  <?php foreach ($keu_departemen as $r ) {?>

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Timeline Program Kerja Departemen <?php echo $r->nama_departemen; ?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>

    <?php } ?>



      <div class="col-md-12 box-body">
  <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>
  <div id="notif"></div>
  <div class="col-md-10"></div>
  <div class="col-md-2">
        <button class="btn btn-success btn-block" id="BarisBaru"><i class="fa fa-plus"></i> Baris Baru</button>
  </div>
    <br><br>
  <form method="POST" class="form-horizontal" action="<?php echo base_url(); ?>departemen/timelineprogja/tambahtimeline_aksi" id="tambahData">
    <div class="col-md-12">
      <table class="table table-bordered" id="tableLoop">
        <thead>
          <tr>
            <th>No</th>
            <th>Program Kerja</th>
            <th>Minggu</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
    <!-- <input type="text" name="id_departemen" value="<?php echo $_GET['id'];?>" hidden> -->
    <!-- <div class='form-group'>
          <label class='col-sm-3 control-label'>Program Kerja :</label>
            <div class='col-sm-8'>
              <select name='o_progja' class='form-control'>
                <option value="" selected>- Pilih Program Kerja -</option>";
                  <?php foreach($progja as $r):?>
                    <option value="<?=$r->id_progja?>"><?=$r->nama_progja?></option>";
                  <?php endforeach; ?>
              </select>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Minggu :</label>
            <div class='col-sm-8'>
              <select name='o_minggu' class='form-control' >
                <option value="" selected>- Pilih Minggu -</option>";
                  <?php foreach($minggu as $r):?>
                <option value="<?=$r->id_minggu?>"><?=$r->nama_minggu?></option>";
                  <?php endforeach; ?>
              </select>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Bulan :</label>
            <div class='col-sm-8'>
              <select name='o_bulan' class='form-control' >
                <option value="" selected>- Pilih Bulan -</option>";
                  <?php foreach($bulan as $r):?>
                <option value="<?=$r->id_bulan?>"><?=$r->nama_bulan?></option>";
                  <?php endforeach; ?>
              </select>
            </div>
    </div>
    <div class='form-group'>
          <label class='col-sm-3 control-label'>Tahun :</label>
            <div class='col-sm-8'>
              <input type="text" class="form-control" name="t_tahun" placeholder="Masukkan Tahun" required>
            </div>
    </div> -->

    <div class="col-md-10"></div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
    </div><br>
    <div class='col-md-12'>
      <a href="<?php echo base_url(); ?>departemen/timelineprogja/lihat/?id=<?php echo $_GET['id'];?>" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
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
<script type="text/javascript">
$(document).ready(function() {
   for(B=1; B<=1; B++){
    Barisbaru();
   }
   $('#BarisBaru').click(function(e) {
       e.preventDefault();
       Barisbaru();
   });

   $("tableLoop tbody").find('input[type=text]').filter(':visible:first').focus();
});
function Barisbaru() {
   $(document).ready(function() {
       $("[data-toggle='tooltip']").tooltip();
   });
   var Nomor = $("#tableLoop tbody tr").length + 1;
   var Baris = '<tr>';
           Baris += '<td class="text-center">'+Nomor+'</td>';
           Baris += '<td>';
              Baris += '<select name="o_progja[]" class="form-control progja" required>';
              Baris += '<option value="" selected>- Pilih Program Kerja -</option>';
              Baris += '<?php foreach($progja as $r):?>';
              Baris += '<option value="<?=$r->id_progja?>"><?=$r->nama_progja?></option>"';
              Baris += '<?php endforeach; ?>';
              Baris += '</select>';
           Baris += '</td>';
           Baris += '<td>';
              Baris += '<select name="o_minggu[]" class="form-control minggu" required>';
              Baris += '<option value="" selected>- Pilih Minggu -</option>';
              Baris += '<?php for($i=1;$i<=4;$i++){?>';
              Baris += '<option value="<?=$i?>"><?=minggu($i)?></option>"';
              Baris += '<?php } ?>';
              Baris += '</select>';
           Baris += '</td>';
           Baris += '<td>';
              Baris += '<select name="o_bulan[]" class="form-control bulan" required>';
              Baris += '<option value="" selected>- Pilih Bulan -</option>';
              Baris += '<?php for($i=1;$i<=12;$i++){?>';
              Baris += '<option value="<?=$i?>"><?=bulan($i)?></option>"';
              Baris += '<?php } ?>';
              Baris += '</select>';
           Baris += '</td>';
           Baris += '<td>';
              Baris += '<select name="o_tahun[]" class="form-control bulan" required>';
              Baris += '<option value="" selected>- Pilih Tahun -</option>';
              Baris += '<?php for($i=$mulai;$i<=$akhir;$i++){?>';
              Baris += '<option value="<?=$i?>"><?=$i?></option>"';
              Baris += '<?php } ?>';
              Baris += '</select>';
           Baris += '</td>';
           Baris += '<td class="text-center">';
               Baris += '<a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Baris" id="HapusBaris"><i class="fa fa-times"></i></a>';
           Baris += '</td>';
           Baris += '</tr>';
           $("#tableLoop tbody").append(Baris);
           $("#tableLoop tbody tr").each(function () {
           $(this).find('td:nth-child(2) input').focus();
         });
}

$(document).on('click', '#HapusBaris', function(e) {
   e.preventDefault();
   var Nomor = 1;
   $(this).parent().parent().remove();
   $('tableLoop tbody tr').each(function() {
       $(this).find('td:nth-child(1)').html(Nomor);
       Nomor++;
   });
});

$(document).ready(function() {
   $('#tambahData').submit(function(e) {
       e.preventDefault();
       timeline();
   });
});

function timeline() {
     $.ajax({
         url:$("#tambahData").attr('action'),
         type:'post',
         cache:false,
         dataType:"json",
         data: $("#tambahData").serialize(),

         success:function (data) {
             if (data.success == true) {
                 $('.progja').val('');
                 $('.minggu').val('');
                 $('.bulan').val('');
                 $('.tahun').val('');
                 $('#notif').fadeIn(800, function() {
                    $("#notif").html(data.notif).fadeOut(5000).delay(800);
                 });
             }
             else{
                 $('#notif').html('<div class="alert alert-danger">Data Gagal Disimpan</div>')
             }
         },
         error:function (error) {
              alert(error);
              console.log(error.responseText);
         }

     });
 }

</script>
