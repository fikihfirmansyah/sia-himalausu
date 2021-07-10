<!-- Left side column. contains the logo and sidebar -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<?php include"function.php"; ?> <!-- FILE Function -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pendapatan
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li class="active">Pendapatan Iuran Pengurus</li>
    </ol>
  </section>
  <!-- Main content -->
    <section class="content">

<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Pendapatan Iuran Pengurus</h3>
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
      <th><center>NIM</center></th>
      <th><center>Nama</center></th>
      <th><center>Amanah</center></th>
      <th><center>Departemen</center></th>
      <th><center>Total Iuran</center></th>
    </tr>
  </thead>
  <tbody>



<?php

$nomor = 1;
foreach ($pendapatan_iuran as $row) { ?>

      <tr style="font-size:14px">
        <td  width="5%"><center><?php echo $nomor; ?></center></td>
        <td><?php echo $row->nim; ?></td>
        <td><?php echo $row->nama; ?></td>
        <td><?php echo $row->nama_amanah; ?></td>
        <td><center><?php if($row->nama_departemen != 0) echo $row->nama_departemen; else echo "-"; ?></center></td>
        <td><?php if($row->total_iuran != 0) echo rupiah($row->total_iuran); else echo "<center>-</center>"; ?></td>
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
