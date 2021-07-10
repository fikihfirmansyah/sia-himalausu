<!-- Left side column. contains the logo and sidebar -->
<?php
include "function.php";  // FILE Function
include "additional_modals_pgl.php"
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
      <li class="active">Pengeluaran</li>
    </ol>
  </section>
  <!-- Main content -->
    <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Pengeluaran</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
        <?php if($tahun > 0 ) {?>
      <a href="<?php echo base_url();?>pengeluaran/lainnya/tambah" title="Tambah" class="btn btn-success btn-m"><i class="fa fa-plus"></i> Tambah Pengeluaran Lainnya</a><p></p>
        <?php } ?>
    <table id="example1" class="table table-bordered table-striped">
  <thead style='background:#008080;color:#fff;'>
    <tr>
      <th><center>No</center></th>
      <th><center>Tanggal</center></th>
      <th><center>Keterangan</center></th>
      <th><center>Jumlah</center></th>
      <th><center>Aksi</center></th>
    </tr>
  </thead>
  <tbody>

<?php

$nomor = 1;
foreach ($keu_pengeluaran_lainnya as $row) { ?>


      <tr style="font-size:14px">
        <td width="5%"><center><?php echo $nomor; ?></center></td>
        <td><?php echo tgl_indo($row->tanggal_pgl); ?></td>
        <td><?php echo $row->keterangan_pgl; ?></td>
        <td><center><?php echo rupiah($row->jumlah_pgl); ?></center></td>
      <td>
        <center>
        <a href="<?php echo base_url(); ?>pengeluaran/lainnya/edit/?id=<?php echo $row->id_peng_lainnya  ;?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
        <a data-toggle="modal" data-target="#hapuspengeluaran_<?php echo $row->id_peng_lainnya;?>" title="Hapus Pengeluaran" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
        </center>
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
