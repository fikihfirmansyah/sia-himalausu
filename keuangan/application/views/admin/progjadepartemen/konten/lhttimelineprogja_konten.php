  <?php include"function.php";
foreach ($timeline as $row) {?>
  <!-- START Modal Hapus Timeline -->
  <div class="modal fade" id="hapustimeline_<?php echo $row->id_timeline_progja; ?>">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Hapus Timeline</h4>
      </div>
      <div class="modal-body">
      <p>Anda ingin menghapus Timeline ini?<br>Tindakan ini tidak dapat dibatalkan!</p>
      <a href="<?php echo base_url(); ?>departemen/timelineprogja/hapustimeline_aksi/?id=<?php echo $row->id_timeline_progja;?>&id_b=<?php echo $row->id_departemen; ?>" class="btn btn-block btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
      <button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
    </div>
  </div>
  <!-- END Modal Hapus Timeline -->
  <?php } ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Timeline Program Kerja
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li class="active">Timeline Program Kerja</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
        <?php include"additional_info.php"; ?> <!-- FILE INFO POP-UP -->
    <div class="box box-success">
      <div class="box-header with-border">
        <?php foreach ($keu_departemen as $row) {
          $keu_departemen = $row->nama_departemen;
        } ?>
        <h3 class="box-title">Timeline Program Kerja Departemen <?php echo $keu_departemen; ?> </h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
      <a href="<?php echo base_url();?>departemen/timelineprogja/tambah/?id=<?php echo $_GET['id']; ?>" title="Edit" class="btn btn-success btn-m"><i class="fa fa-plus"></i> Tambah Timeline Program Kerja</a><p></p>
  <?php
  foreach ($waktu as $row) { ?>
    <br>
    <center><span style="font-size:20px;font-weight:bold"> <?php echo bulan($row->bulan)." ".$row->tahun ?> </span></center>

    <br>
<table class="table table-bordered table-striped">
<thead style='background:#008080;color:#fff;'>
<tr>
<th width="5%"><center>No</center></th>
<th><center>Program Kerja</center></th>
<th><center>Estimasi Biaya</center></th>
<th><center>Minggu</center></th>
<th width="10%"><center>Aksi</center></th>
</tr>
</thead>
<tbody>


<?php
$nomor = 1;
foreach ($timeline as $r) {
if($row->bulan == $r->bulan && $row->tahun == $r->tahun){
?>
<tr style="font-size:13px">
  <td><center><?php echo $nomor; ?></center></td>
  <td width='30%'><?php echo $r->nama_progja; ?></td>
  <td><center><?php echo rupiah($r->estimasi_biaya); ?></center></td>
  <td><center><?php echo minggu($r->minggu); ?></center></td>
  <td width='20%'><center>
    <a href="<?php echo base_url(); ?>departemen/timelineprogja/edit/?id=<?php echo $r->id_timeline_progja ;?>&keu_departemen=<?php echo $_GET['id']; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
    <a data-toggle="modal" data-target="#hapustimeline_<?php echo $r->id_timeline_progja;?>" title="Hapus Progja" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
  </center></td>
</tr>
<?php $nomor++;}} ?>
</tbody>

</table>
<?php } ?>
<br><br>
<a href="<?php echo base_url(); ?>departemen/timelineprogja/data" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>



  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

      </table>

          <a data-dismiss="modal" title="Kembali" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
          <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
        </form>
  	  </div>
  	</div>
    </div>
  </div>
  <!-- END Modal Edut Departemen -->



  </div>
</div>








  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
