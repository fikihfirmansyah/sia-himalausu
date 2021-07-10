<?php include 'function.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Kepengurusan
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li class="active">Tahun Kepengurusan</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Tahun Kepngurusan <?php echo $org; ?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
        <a href="<?php echo base_url();?>kepengurusan/thnkepengurusan/tambah" title="Edit" class="btn btn-success btn-m"><i class="fa fa-plus"></i> Tambah Tahun Kepengurusan</a><p></p>
    <table id="example1" class="table table-bordered table-striped">
  <thead style='background:#008080;color:#fff;'>
    <tr>
      <th><center>No</center></th>
      <th><center>Keterangan</center></th>
      <th><center>Tanggal Mulai</center></th>
      <th><center>Tanggal Akhir</center></th>
      <th><center>Status</center></th>
      <th><center>Aksi</center></th>
    </tr>
  </thead>
  <tbody>



<!-- FILE MODALS -->
<?php
include"additional_modals_thnkepengurusan.php";
?>
<?php
$nomor = 1;
foreach ($thnkepengurusan as $row) { ?>
      <tr style="font-size:14px">
        <td  width="5%"><center><?php echo $nomor; ?></center></td>
        <td><?php echo $row->keterangan; ?></td>
        <td><center><?php echo tgl_indo($row->mulai); ?></center></td>
        <td><center><?php echo tgl_indo($row->akhir); ?></center></td>
        <td><center><?php $row->aktif == 'Y' ? $status = "BUKA" : $status = "TUTUP" ;  echo $status;?></center></td>
      <td>
        <center>
          <a href="<?php echo base_url(); ?>kepengurusan/thnkepengurusan/edit/?id=<?php echo $row->id_thnkepengurusan  ;?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
          <a data-toggle="modal" data-target="#hapusthnkepengurusan_<?php echo $row->id_thnkepengurusan;?>" title="Hapus Tahun Kepengurusan" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
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
