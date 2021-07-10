<!-- Left side column. contains the logo and sidebar -->
<?php
  include "function.php";
  include "additional_modals_pd.php"
?> <!-- FILE Function -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pendapatan
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li class="active">Pendapatan Donatur</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Pendapatan Donatur</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
        <?php if($tahun > 0 ) {?>
          <a href="<?php echo base_url();?>pendapatan/keu_donatur/tambah" title="Tambah" class="btn btn-success btn-m"><i class="fa fa-plus"></i> Tambah Pendapatan Donatur</a><p></p>
        <?php } ?>
    <table id="example1" class="table table-bordered table-striped">
  <thead style='background:#008080;color:#fff;'>
    <tr>
      <th><center>No</center></th>
      <th><center>Nama</center></th>
      <th><center>Tanggal</center></th>
      <th><center>Jumlah</center></th>
      <th><center>Resi Pembayaran</center></th>
      <th><center>Aksi</center></th>
    </tr>
  </thead>
  <tbody>



<?php

$nomor = 1;
foreach ($keu_pendapatan_donatur as $row) { ?>


      <tr style="font-size:14px">
        <td  width="5%"><center><?php echo $nomor; ?></center></td>
        <td><?php echo $row->nama_donatur; ?></td>
        <td><?php echo tgl_indo($row->tanggal_pemberian); ?></td>
        <td><center><?php echo rupiah($row->jumlah_pemberian); ?></center></td>
        <td><center><img src="<?php echo base_url(); ?>assets/image/resi_donatur/<?php echo $row->resi_donatur;?>" width="30px"></center></td>
      <td>
        <center>
        <a href="<?php echo base_url(); ?>pendapatan/keu_donatur/edit/?id=<?php echo $row->id_p_donatur  ;?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
        <a data-toggle="modal" data-target="#hapuspendapatan_<?php echo $row->id_p_donatur;?>" title="Hapus Pendapatan" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
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
