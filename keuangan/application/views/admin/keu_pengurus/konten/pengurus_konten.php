<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengurus
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li class="active">Data Pengurus</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Pengurus <?php echo $org; ?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
        <?php if($tahun > 0 ) {?>
        <a href="<?php echo base_url();?>pengurus/daftarpengurus/tambah" title="Tambah" class="btn btn-success btn-m"><i class="fa fa-plus"></i> Tambah Pengurus</a><p></p>
        <?php } ?>
    <table id="example1" class="table table-bordered table-striped" >
  <thead style='background:#008080;color:#fff;'>
    <tr>
      <th width="5%">No</th>
      <th>Nim</th>
      <th>Nama</th>
      <th>Amanah</th>
      <th>Departemen</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>



<!-- FILE MODALS -->
<?php
include"additional_modals_pengurus.php";
?>
<?php
$nomor = 1;
foreach ($keu_pengurus as $row) { ?>
      <tr style="font-size:14px">
        <td><center><?php echo $nomor; ?></center></td>
        <td><?php echo $row->nim; ?></td>
        <td><?php echo $row->nama; ?></td>
        <td><?php echo $row->nama_amanah; ?></td>
        <td><?php if($row->nama_departemen != NULL) echo $row->nama_departemen;
            else echo "-";?></td>
      <td>
        <a href="<?php echo base_url(); ?>pengurus/daftarpengurus/edit/?nim=<?php echo $row->nim ;?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
        <a data-toggle="modal" data-target="#hapuspengurus_<?php echo $row->nim;?>" title="Hapus Pengurus" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
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
