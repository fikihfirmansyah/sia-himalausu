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
        <li><a href="<?php echo base_url(); ?>pengaturan/akun/infoakun"><i class="fa fa-folder-open"></i> Organisasi</a></li>
	        <li class="active"><i class="fa fa-folder-open"></i> Info Organisasi</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">

<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Organisasi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="col-md-12 box-body">




        <table class="table">
                  <tr>
                    <td width="30%">Nama Organisasi</td>
                    <td>: <?php echo $org;?></td>
                  </tr>
                  <tr>
                    <td width="30%">Universitas</td>
                    <td>: <?php echo $keu_univ; ?> </td>
                  </tr>
                  <tr>
                    <td width="30%">Logo</td>
                    <td>:<img src="<?php echo base_url(); ?>assets/image/<?php echo $logo_org ;?>" width="200px"></td>
                  </tr>



  			</table>

			<br>

			<a href="<?php echo base_url(); ?>pengaturan/org/editorg" title="Edit Password" class="btn btn-default"><i class="fa fa-edit"></i> Edit Data</a>




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
