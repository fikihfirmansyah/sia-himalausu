<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php foreach ($keu_donatur as $row) { ?>
<!-- START Modal Hapus Donatur -->
<div class="modal fade" id="hapusdonatur_<?php echo $row->id_donatur; ?>">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Hapus Donatur</h4>
	  </div>
	  <div class="modal-body">
		<p>Anda ingin menghapus Donatur ini?<br>Tindakan ini tidak dapat dibatalkan!</p>
		<a href="<?php echo base_url(); ?>donatur/daftardonatur/hapusdonatur_aksi/?id=<?php echo $row->id_donatur;?>" class="btn btn-block btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
		<button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Hapus Donatur -->
<?php } ?>
