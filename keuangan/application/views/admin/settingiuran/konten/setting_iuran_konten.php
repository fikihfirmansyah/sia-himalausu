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
	        <li class="active"><i class="fa fa-folder-open"></i> Iuran Pengurus</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">

<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
<?php include"function.php" ?>

    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Iuran Pengurus</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="col-md-4 box-body">



        <?php foreach ($keu_setting as $row) { ?>



        <table class="table">
                  <tr>
                    <td>Bulan Awal Pembayaran</td>
                    <td>: <?php if($row->tanggal_awal != NULL)echo tgl_indo($row->tanggal_awal); else echo "-";?></td>
                  </tr>
                  <tr>
                    <td>Besar Iuran per Bulan</td>
                    <td>: <?php echo rupiah($row->keu_iuran_pengurus); ?> </td>
                  </tr>
                  <tr>
                    <td>Saldo Kas</td>
                    <td>: <?php echo rupiah($row->saldo_kas); ?> </td>
                  </tr>

  			</table>

			<br>

			<a href="<?php echo base_url(); ?>pengaturan/iuranpengurus/edit" title="Edit Password" class="btn btn-default"><i class="fa fa-edit"></i> Edit Data</a>

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
