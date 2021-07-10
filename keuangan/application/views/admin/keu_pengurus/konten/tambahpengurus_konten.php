<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Pengurus</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li><a href="<?php echo base_url(); ?>pengurus/daftarpengurus/data"><i class="fa fa-folder-open"></i> Data Pengurus</a></li>
        <li class="active"><i class="fa fa-folder-open"></i> Tambah Pengurus</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Pengurus <?php echo $org; ?></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>




      <div class="col-md-12 box-body">
        <?php echo (isset($_GET['error']))? "<div class='alert alert-danger'>$_GET[error]</div>" : ""; ?>
        <div id="notif"></div>
        <div class="col-md-10"></div>
        <div class="col-md-2">
              <button class="btn btn-success btn-block" id="BarisBaru"><i class="fa fa-plus"></i> Baris Baru</button>
        </div>
          <br><br>
  <form method="POST" class="form-horizontal" action="<?php echo base_url(); ?>pengurus/daftarpengurus/tambahpengurus_aksi" id="tambahData">
    <div class="col-md-12">
      <table class="table table-bordered" id="tableLoop">
        <thead>
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Departemen</th>
            <th>Amanah</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>

        <div class="col-md-10"></div>
        <div class='col-md-2'>
          <button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-ok"></i> Tambah</button>
        </div><br>
        <div class="col-md-12">
          <a href="<?php echo base_url(); ?>pengurus/daftarpengurus/data" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
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
               Baris += '<input type="text" name="t_nim[]" class="form-control nim" placeholder="Masukkan NIM" required>';
           Baris += '</td>';
           Baris += '<td>';
               Baris += '<input type="text" name="t_nama[]" class="form-control nama" placeholder="Masukkan Nama" required>';
           Baris += '</td>';
           Baris += '<td>';
              Baris += ' <select name="o_departemen[]" class="form-control keu_departemen">';
              Baris += '<option value="" selected>- Pilih Departemen -</option>';
              Baris += '<option value=""> - </option>';
              Baris += '<?php foreach($keu_departemen as $r):?>';
              Baris += '<option value="<?=$r->id_departemen?>"><?=$r->nama_departemen?></option>"';
              Baris += '<?php endforeach; ?>';
              Baris += '</select>';
           Baris += '</td>';
           Baris += '<td>';
              Baris += ' <select name="o_amanah[]" class="form-control" keu_amanah required>';
              Baris += '<option value="" selected>- Pilih Amanah -</option>';
              Baris += '<?php foreach($keu_amanah as $r):?>';
              Baris += '<option value="<?=$r->id_amanah?>"><?=$r->nama_amanah?></option>"';
              Baris += '<?php endforeach; ?>';
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
       biodata();
   });
});

function biodata() {
     $.ajax({
         url:$("#tambahData").attr('action'),
         type:'post',
         cache:false,
         dataType:"json",
         data: $("#tambahData").serialize(),

         success:function (data) {
             if (data.success == true) {
                 $('.nim').val('');
                 $('.nama').val('');
                 $('.keu_departemen').val('');
                 $('.keu_amanah').val('');
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
         }

     });
 }


</script>
