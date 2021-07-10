<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php foreach ($keu_pendapatan_donatur as $row) { ?>
<!-- FILE MODALS -->
<!-- START Modal Hapus Pendapatan Donatur -->
<div class="modal fade" id="hapuspendapatan_<?php echo $row->id_p_donatur; ?>">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Hapus Pendapatan</h4>
	  </div>
	  <div class="modal-body">
		<p>Anda ingin menghapus Pendapatan ini?<br>Tindakan ini tidak dapat dibatalkan!</p>
		<a href="<?php echo base_url(); ?>pendapatan/keu_donatur/hapuspendapatan_aksi/?id=<?php echo $row->id_p_donatur;?>" class="btn btn-block btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
		<button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Hapus Pendapatan Donatur -->
<?php } ?>
