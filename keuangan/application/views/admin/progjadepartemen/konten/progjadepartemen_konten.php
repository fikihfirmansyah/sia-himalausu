<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengaturan
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li class="active">Program Kerja</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

<?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Program Kerja <?php echo $org; ?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
    <table id="example1" class="table table-bordered table-striped">
  <thead style='background:#008080;color:#fff;'>
    <tr>
      <th><center>No</center></th>
      <th><center>Nama Departemen</center></th>
      <th><center>Jumlah Program Kerja</center></th>
      <th><center>Aksi</center></th>
    </tr>
  </thead>
  <tbody>



<!-- FILE MODALS -->
<?php
$nomor = 1;
foreach ($progja_departemen as $row) { ?>
      <tr style="font-size:14px">
        <td  width="5%"><center><?php echo $nomor; ?></center></td>
        <td><?php echo $row->nama_departemen; ?></td>
        <td><center><?php echo $row->jumlah; ?></center></td>
      <td><center>
        <a href="<?php echo base_url(); ?>departemen/progjadepartemen/detail/?id=<?php echo $row->id_departemen ;?>" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
      </center></td>
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
